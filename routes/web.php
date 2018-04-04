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

//Login Route
Route::get('/login', function () {
    //Validate if donor is authenticated
    if (Auth::guard('donor')->check()) {
        return redirect('/donor/homepage');
    } elseif (Auth::guard('staff')->check()) {                  //Validate if staff is authenticated
        if (Auth::guard('staff')->user()->staffPos === 1)       //Verify staff position is HR Manager
            return redirect('/staff/hr/homepage');
        elseif (Auth::guard('staff')->user()->staffPos === 0)   //Verify staff position is Nurse
            return redirect('/staff/nurse/homepage');
    } else {
        return view('login');                              //Redirect default guest to login page
    }
})->name('login');

/***** Non-Auth Routes *****/
//Donor Login & Register Route
Route::post('/donor/login', 'DonorAuth\LoginController@login');
Route::get('/donor/register', 'DonorAuth\RegisterController@showRegistrationForm')->name('register');
Route::post('/donor/register', 'DonorAuth\RegisterController@register');

//Donor Reset Password Route
Route::post('/donor/password/email', 'DonorAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
Route::post('/donor/password/reset', 'DonorAuth\ResetPasswordController@reset')->name('password.email');
Route::get('/donor/password/reset', 'DonorAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::get('/donor/password/reset/{token}', 'DonorAuth\ResetPasswordController@showResetForm');

//Staff Login Route
Route::post('/staff/login', 'StaffAuth\LoginController@login');

//Staff Reset Password Route
Route::post('/staff/password/email', 'StaffAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
Route::post('/staff/password/reset', 'StaffAuth\ResetPasswordController@reset')->name('password.email');
Route::get('/staff/password/reset', 'StaffAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::get('/staff/password/reset/{token}', 'StaffAuth\ResetPasswordController@showResetForm');


//Donor Routes grouped under "/donor/..."
Route::group(['prefix' => 'donor', 'middleware' => 'auth:donor'], function () {

    //Homepage
    Route::get('/homepage', 'EventController@indexShort');

    //Logout
    Route::post('/logout', 'DonorAuth\LoginController@logout')->name('logout');

    //Donor profile view, edit and deactivate
    Route::get('/profile', 'DonorController@edit');
    Route::post('/profile', 'DonorController@update');
    Route::post('/profile/password', 'DonorController@changePassword');
    Route::post('/profile/deactivate', 'DonorController@deactivate');

    //Upcoming events and booking of events
    Route::get('/upcoming-events', 'EventController@index');
    Route::get('/upcoming-events/{id}', 'EventController@show');
    Route::post('{id}/reserve', 'ReservationController@store');

    //Reservation
    Route::get('/reservation', 'ReservationController@index');
    Route::get('/reservation/current', 'ReservationController@resvCurrent');
    Route::get('/reservation/{id}', 'ReservationController@show');
    Route::post('/reservation/{id}/cancel', 'ReservationController@deactivate');

    //Donor blood donation
    Route::get('/donation', function () {
        return view('donor.donate-history');
    });
    Route::get('/donation/detail', function () {
        return view('donor.donate-history-details');
    });

});

//HR Manager Routes grouped under "/staff/hr/..."
Route::group(['prefix' => 'staff/hr', 'middleware' => ['auth:staff', 'HRStaff']], function () {

    //Homepage
    Route::get('/homepage', 'StaffEventController@indexShort');

    //Logout
    Route::post('/logout', 'StaffAuth\LoginController@logout')->name('logout');

    //Staff profile view, edit and deactivate
    Route::get('/profile', 'StaffController@edit');
    Route::post('/profile', 'StaffController@update');
    Route::post('/profile/deactivate', 'StaffController@deactivate');

    /***** REGISTER SECTION *****/
    //Staff Register
    Route::get('/registration', 'StaffEventController@create')->name('register');
    Route::post('/registration', 'StaffAuth\RegisterController@register');

    //Event Register
    Route::post('/registration/event', 'StaffEventController@store');

    //Room register
    Route::post('/registration/room', 'StaffRoomController@store');


    /***** LIST SECTION *****/
    Route::get('/list/donor', 'StaffDonorController@index');
    Route::get('/list/donor/{id}', 'StaffDonorController@show');

    Route::get('/list/staff', 'StaffController@index');
    Route::get('/list/staff/{id}', 'StaffController@show');
    Route::post('/list/staff/{id}', 'StaffController@updateHR');
    Route::post('/list/staff/{id}/deactivate', 'StaffController@deactivateHR');

    Route::get('/list/event', 'StaffEventController@index');
    Route::get('/list/event/{id}', 'StaffEventController@show');
    Route::post('/list/event/{id}', 'StaffEventController@update');
    Route::post('/list/event/{id}/cancel', 'StaffEventController@deactivate');


    Route::get('/dashboard', function () {
        return view('staff.dashboard');
    });
});

//Nurse Routes grouped under "/staff/nurse/..."
Route::group(['prefix' => 'staff/nurse', 'middleware' => ['auth:staff', 'NurseStaff']], function () {

    //Homepage
    Route::get('/homepage', 'StaffEventController@indexShortNurse');

    //Logout
    Route::post('/logout', 'StaffAuth\LoginController@logout')->name('logout');

    //Profile view, edit and deactivate
    Route::get('/profile', 'StaffController@edit');
    Route::post('/profile', 'StaffController@update');
    Route::post('/profile/deactivate', 'StaffController@deactivate');

    /***** LIST SECTION *****/
    Route::get('/list/schedule', 'StaffScheduleController@index');
    Route::get('/list/schedule/{id}', 'StaffScheduleController@show');

    Route::get('/manage-blood', function () {
        return view('staff.blood-management');
    });
});
