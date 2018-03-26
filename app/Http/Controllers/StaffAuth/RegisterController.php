<?php

namespace App\Http\Controllers\StaffAuth;

use App\Staff;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
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
    protected $redirectTo = '/staff/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('staff.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'staffPos' => ['required', 'boolean'],
			'firstName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
            'lastName' => ['required', 'string', 'min:2', 'max:255', 'regex:/[A-Za-z\-@ ]{2,}/'],
            'ICNum' => ['required', 'min:12', 'max:12', 'unique:staffs', 'regex:/\d{12}/'],
            'phoneNum' => ['required', 'max:20', 'regex:/([0-9]|[0-9\-]){3,20}/'],
            'emailAddress' => 'required|email|max:255|unique:staffs',
            'birthDate' => 'required|date',
            'password' => 'required|min:6|max:255|confirmed',
            'homeAddress' => 'required|max:500'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Staff
     */
    protected function create(array $data)
    {
		//Generate donor ID, get year and get the latest donor count
        $staffID = 'D' . date('y') . sprintf('%04d', count(Staff::all()) + 1);
		
		//Return the created staff instance and store in DB
        return Staff::create([
			'staffID' => $staffID,
            'staffPos' => $data['staffPos'],
			'firstName' => $data['firstName'],
			'lastName' => $data['lastName'],
			'ICNum' => $data['ICNum'],
			'phoneNum' => $data['phoneNum'],
            'emailAddress' => $data['emailAddress'],
			'birthDate' => $data['birthDate'],
            'password' => bcrypt($data['password']),
			'homeAddress' => $data['homeAddress'],
			'donorAccStatus' => 1,
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('staff.auth.registerStaff');	//Return registration form in "staff" > "auth" folder
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('staff');
    }
}
