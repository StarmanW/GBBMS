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
Route::get('/donation', function () {
    return view('donor.donate-history');
});

Route::get('/donation/detail', function () {
    return view('donor.donate-history-details');
});

Route::get('/profile', function () {
    return view('donor.donor-profile');
});

Route::get('/event', function () {
    return view('donor.event-details-donor');
});

Route::get('/home', function () {
    return view('donor.home');
});

Route::get('/registration', function () {
    return view('donor.registerDonor');
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
//TEST END

//Login Route
Route::get('/login', function () {
    return view('login');
});

//Donor Routes
Route::group(['prefix' => 'donor'], function () {

    //Donor Login
    Route::get('/login', 'DonorAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'DonorAuth\LoginController@login');
    Route::post('/logout', 'DonorAuth\LoginController@logout')->name('logout');

    //Donor Register
    Route::get('/register', 'DonorAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'DonorAuth\RegisterController@register');

    //Donor Reset Password
    Route::post('/password/email', 'DonorAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'DonorAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'DonorAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'DonorAuth\ResetPasswordController@showResetForm');
});

//Staff Routes
Route::group(['prefix' => 'staff'], function () {

    //Staff Login
    Route::get('/login', 'StaffAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'StaffAuth\LoginController@login');
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
