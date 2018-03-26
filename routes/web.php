<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//TEST

/**** DONOR TEST SECTION ****/
Route::get('/donation', function () {
    return view('donor.donate-history');
});

Route::get('/donation/detail', function () {
    return view('donor.donate-history-details');
});

Route::get('/event', function () {
    return view('donor.event-details-donor');
});

Route::get('/reservation', function () {
    return view('donor.resv-list');
});

Route::get('/reservation/detail', function () {
    return view('donor.resv-details');
});

Route::get('/upcoming-events', function () {
    return view('donor.upcoming-event-list');
});

/**** STAFF TEST SECTION ****/
Route::get('/manage', function () {
    return view('staff.blood-management');
});

Route::get('/dash', function () {
    return view('staff.dashboard');
});

Route::get('/donor/profile', function () {
    return view('staff.donor-profile-hr');
});

Route::get('/donor', function () {
    return view('staff.donor-list');
});

Route::get('/event', function () {
    return view('staff.event-list');
});

Route::get('/event/detail', function () {
    return view('staff.event-details-hr');
});

Route::get('/home/hr', function () {
    return view('staff.home-hr');
});

/**** NURSE TEST SECTION ****/
Route::get('/home/nurse', function () {
    return view('staff.home-nurse');
});

Route::get('/staff/registration', function () {
    return view('staff.registration');
});

Route::get('/staff/schedule/detail', function () {
    return view('staff.schedule-details');
});

Route::get('/staff/schedule', function () {
    return view('staff.schedule-list');
});

Route::get('/staff/list', function () {
    return view('staff.staff-list');
});

Route::get('/staff/hr/profile', function () {
    return view('staff.staff-profile');
});

Route::get('/staff/nurse/profile', function () {
    return view('staff.staff-profile-nurse');
});

//TEST END


//Login Route
Route::get('/login', function () {
    if (Auth::guard('donor')->check()) {
        return redirect('/donor/home');
    } elseif (Auth::guard('staff')->check()) {
        return redirect('/staff/home');
    } else {
        return view('login');
    }
});

//Donor Login & Register Route
Route::get('/donor/register', 'DonorAuth\RegisterController@showRegistrationForm')->name('register');
Route::post('/donor/register', 'DonorAuth\RegisterController@register');
Route::get('/donor/login', 'DonorAuth\LoginController@showLoginForm')->name('login');
Route::post('/donor/login', 'DonorAuth\LoginController@login');

//Donor Reset Password
Route::post('/donor/password/email', 'DonorAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
Route::post('/donor/password/reset', 'DonorAuth\ResetPasswordController@reset')->name('password.email');
Route::get('/donor/password/reset', 'DonorAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::get('/donor/password/reset/{token}', 'DonorAuth\ResetPasswordController@showResetForm');

//Donor Routes grouped under "/donor/..."
Route::group(['prefix' => 'donor', 'middleware' => 'auth:donor'], function () {

    Route::post('/logout', 'DonorAuth\LoginController@logout')->name('logout');

    Route::get('/profile', 'DonorController@edit');
    Route::post('/profile', 'DonorController@update');
    Route::post('/profile/deactivate', 'DonorController@deactivate');

});


//Staff Login
Route::get('/staff/login', 'StaffAuth\LoginController@showLoginForm')->name('login');
Route::post('/staff/login', 'StaffAuth\LoginController@login');

//Staff Routes grouped under "/staff/..."
Route::group(['prefix' => 'staff'], function () {

    Route::post('/logout', 'StaffAuth\LoginController@logout')->name('logout');

    //Staff Register
    Route::get('/register', 'StaffAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'StaffAuth\RegisterController@register');

    //Staff Reset Password
    Route::post('/password/email', 'StaffAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'StaffAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'StaffAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'StaffAuth\ResetPasswordController@showResetForm');
});
