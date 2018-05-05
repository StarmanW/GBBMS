<?php

namespace App\Http\Controllers\DonorAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;

class LoginController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/donor/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('donor.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm() {
        return redirect('login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard() {
        return Auth::guard('donor');
    }

    //Overwrite default username function which returns "email"
    public function username() {
        return 'emailAddress';
    }

    /**
     * Send the response after the user was authenticated.
     *
     * Overwrite to check donor account status
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request) {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);

        //Verify whether donor account is deactivated
        if ($this->guard()->user()->donorAccStatus === 0) {
            $request->session()->invalidate();
            return redirect('/login')->with('deactivated', "Your donor account has been deactivated, please contact the support staff to reactivate.");
        } else {
            return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
        }
    }

    //Overwrite default logout function to redirect to "/login"
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/login');
    }
}
