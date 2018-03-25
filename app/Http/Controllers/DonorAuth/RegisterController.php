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
            'firstName' => ['required', 'string', 'min:2', 'regex:/[A-Za-z\-@ ]{2,}/'],
            'lastName' => ['required', 'string', 'min:2', 'regex:/[A-Za-z\-@ ]{2,}/'],
            'ICNum' => ['required', 'min:12', 'max:12', 'regex:/\d{12}/'],
            'phoneNum' => ['required', 'max:20', 'regex:/([0-9]|[0-9\-]){3,20}/'],
            'emailAddress' => 'required|email|max:255|unique:donors',
            'birthDate' => 'required|date',
            'password' => 'required|min:6|confirmed',
            'bloodType' => ['required', 'regex:/[1-8]{1}/'],
            'homeAddress' => 'required'
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

        //Return the created donor instance and store in DB
        return Donor::create([
            'donorID' => $donorID,
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'ICNum' => $data['ICNum'],
            'phoneNum' => $data['phoneNum'],
            'emailAddress' => $data['emailAddress'],
            'birthDate' => $data['birthDate'],
            'password' => bcrypt($data['password']),
            'bloodType' => $data['bloodType'],
            'homeAddress' => $data['homeAddress'],
            'donorAccStatus' => 1,
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm() {
        return view('donor.auth.registerDonor');    //Return registration form in "donor" > "auth" folder
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
