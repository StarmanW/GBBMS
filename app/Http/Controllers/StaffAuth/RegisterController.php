<?php

namespace App\Http\Controllers\StaffAuth;

use App\Models\Staff;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/staff/hr/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //authenticate user
        $this->middleware('auth:staff');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        //Defining custom validation message - Since "before" already have an existing custom
        //validation message in "rescources > lang > en > validation.php". Will override if
        //2 same attribute exist in "validation.php" file
        //Custom message is passed as the third parameter in Validator::make();
        $customValidationMsg = [
            'before' => 'The nurse must be 18 years old and above to register an account.'
        ];
        
        return Validator::make($data, [
            'staffPos' => ['required', 'boolean'],
            'firstName' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-z\-\@ ]{2,}$/'],
            'lastName' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-z\-\@ ]{2,}$/'],
            'ICNum' => ['required', 'min:12', 'max:12', 'unique:staff', 'regex:/^\d{12}$/'],
            'phoneNum' => ['required', 'max:20', 'regex:/^([0-9]|[0-9\-]){3,20}$/'],
            'emailAddress' => 'required|email|max:255|unique:staff',
            'birthDate' => 'required|date|before:18 years ago',
            'gender' => ['required', 'boolean'],
            'profileImage' => 'image|nullable|max:1999',
            'homeAddress' => 'required|max:500'
        ], $customValidationMsg);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     */
    protected function create(array $data) {

        //Get the staff position
        $staffPos = $data['staffPos'] === 1 ? 'H' : 'N';

        //Generate staff ID, get year and get the latest staff count
        $staffID = 'S' . $staffPos . date('y') . sprintf('%03d', count(Staff::all()) + 1);

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

        // Create new staff instance and store in DB
        Staff::create([
            'staffID' => $staffID,
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'ICNum' => $data['ICNum'],
            'phoneNum' => $data['phoneNum'],
            'emailAddress' => $data['emailAddress'],
            'birthDate' => $data['birthDate'],
            'password' => bcrypt($data['ICNum']),
            'gender' => $data['gender'],
            'profileImage' => $fileNameToStore,
            'homeAddress' => $data['homeAddress'],
            'staffPos' => $data['staffPos'],
            'staffAccStatus' => 1,
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        $validator = $this->validator($request->all());

        // If validation failed
        if ($validator->fails()) {
            return response()->json(['validationFailed' => true, 'validationData' => $validator->errors()]);
        } else {
            $this->create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Nurse successfully registered!'
            ]);
        }
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm() {
        return view('staff.hrm.registration');    //Return registration form in "staff" > "auth" folder
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard() {
        return Auth::guard('staff');
    }
}
