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
        return redirect('/donor/home');
    } elseif (Auth::guard('staff')->check()) {                  //Validate if staff is authenticated
        if (Auth::guard('staff')->user()->staffPos === 1)       //Verify staff position is HR Manager
            return redirect('/staff/hr/home');
        elseif (Auth::guard('staff')->user()->staffPos === 0)   //Verify staff position is Nurse
            return redirect('/staff/nurse/home');
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

    Route::post('/logout', 'DonorAuth\LoginController@logout')->name('logout');

    Route::get('/profile', 'DonorController@edit');
    Route::post('/profile', 'DonorController@update');
    Route::post('/profile/deactivate', 'DonorController@deactivate');

    Route::get('/reservation/current', function () {
        return view('donor.resv-current');
    });

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

    //Logout
    Route::post('/logout', 'StaffAuth\LoginController@logout')->name('logout');

    //Profile view, edit and deactivate
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
