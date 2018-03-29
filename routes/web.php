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
    if (Auth::guard('donor')->check()) {
        return redirect('/donor/home');
    } elseif (Auth::guard('staff')->check()) {
        return redirect('/staff/home');
    } else {
        return view('login');
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
Route::post('/password/email', 'StaffAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
Route::post('/password/reset', 'StaffAuth\ResetPasswordController@reset')->name('password.email');
Route::get('/password/reset', 'StaffAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::get('/password/reset/{token}', 'StaffAuth\ResetPasswordController@showResetForm');


//Donor Routes grouped under "/donor/..."
Route::group(['prefix' => 'donor', 'middleware' => 'auth:donor'], function () {

    Route::post('/logout', 'DonorAuth\LoginController@logout')->name('logout');

    Route::get('/profile', 'DonorController@edit');
    Route::post('/profile', 'DonorController@update');
    Route::post('/profile/deactivate', 'DonorController@deactivate');

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
});

//HR Manager Routes grouped under "/staff/hr/..."
Route::group(['prefix' => 'staff/hr', 'middleware' => ['auth:staff', 'HRStaff']], function () {

    Route::get('/home', function () {
        return view('staff.home-hr');
    });

    Route::post('/logout', 'StaffAuth\LoginController@logout')->name('logout');

    //Staff Register
    Route::get('/registration', 'StaffEventController@create')->name('register');
    Route::post('/registration', 'StaffAuth\RegisterController@register');

    Route::post('/registration/event', 'StaffEventController@store');

    Route::get('/dashboard', function () {
        return view('staff.dashboard');
    });

    Route::get('/profile', 'StaffController@edit');
    Route::post('/profile/deactivate', 'StaffController@deactivate');

    Route::get('/list/staff', function () {
        return view('staff.staff-list');
    });

    Route::get('/list/donor', function () {
        return view('staff.donor-list');
    });

    Route::get('/list/donor/{id}', function () {
        return view('staff.donor-profile-hr');
    });

    Route::get('/list/event', function () {
        return view('staff.event-list');
    });

    Route::get('/list/event/{id}', function () {
        return view('staff.event-details-hr');
    });
});

//Nurse Routes grouped under "/staff/nurse/..."
Route::group(['prefix' => 'staff/nurse', 'middleware' => ['auth:staff', 'NurseStaff']], function () {

    Route::get('/home', function () {
        return view('staff.home-nurse');
    });

    Route::post('/logout', 'StaffAuth\LoginController@logout')->name('logout');

    Route::get('/profile', 'StaffController@edit');
    Route::post('/profile/deactivate', 'StaffController@deactivate');

    Route::get('/schedule', function () {
        return view('staff.schedule-list');
    });

    Route::get('/manage-blood', function () {
        return view('staff.blood-management');
    });

    Route::get('/schedule/detail', function () {
        return view('staff.schedule-details');
    });

});
