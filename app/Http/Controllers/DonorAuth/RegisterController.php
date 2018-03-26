<?php

namespace App\Http\Controllers\DonorAuth;

use App\Donor;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/donor/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('donor.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {

        //Data Input Validation
        return Validator::make($data, [
            'firstName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
            'lastName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
            'ICNum' => ['required', 'min:12', 'max:12', 'regex:/\d{12}/'],
            'phoneNum' => ['required', 'max:20', 'regex:/([0-9]|[0-9\-]){3,20}/'],
            'emailAddress' => 'required|email|max:255|unique:donors',
            'birthDate' => 'required|date',
            'password' => 'required|min:6|max:255|confirmed',
            'bloodType' => ['required', 'regex:/[1-8]{1}/'],
            'gender' => ['required', 'boolean'],
            'profileImage' => 'image|nullable|max:1999',
            'homeAddress' => 'required|max:500'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return Donor
     */
    protected function create(array $data) {

        //Generate donor ID, get year and get the latest donor count
        $donorID = 'D' . date('y') . sprintf('%04d', count(Donor::all()) + 1);


        //Handle file upload
        if (isset($data['profileImage']) && $data['profileImage'] !== null) {
            //Get filename
            $fileNameWithExt = $data['profileImage']->getClientOriginalName();
            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $data['profileImage']->getClientOriginalExtension();
            //Filename to store, add timestamp for uniqueness of images that
            //might have the same name.
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            //Upload Image
            /*
             * By default, storage folder is not accessible.
             * Required to run "php artisan storage:link" command to create a sym link
             * between the storage folder and the public folder.
             */
            $path = $data['profileImage']->storeAs('public/profileImage', $fileNameToStore);
        } else {
            $fileNameToStore = 'defaultProfileImage.jpg';
        }

        $donor = Donor::create([
            'donorID' => $donorID,
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'ICNum' => $data['ICNum'],
            'phoneNum' => $data['phoneNum'],
            'emailAddress' => $data['emailAddress'],
            'birthDate' => $data['birthDate'],
            'password' => bcrypt($data['password']),
            'bloodType' => $data['bloodType'],
            'gender' => $data['gender'],
            'profileImage' => $fileNameToStore,
            'homeAddress' => $data['homeAddress'],
            'donorAccStatus' => 1,
        ]);
        
        //Return the created donor instance and store in DB
        return $donor;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm() {
        return view('donor.registerDonor');    //Return registration form in "donor" > "auth" folder
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard() {
        return Auth::guard('donor');
    }
}
