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

/***** Non-Auth Routes *****/
Route::group(['middleware' => ['web', 'staff.guest', 'donor.guest']], function () {
    //Main homepage
    Route::get('/', function () {
        return view('index');
    });

    //Login Route
    Route::get('/login', function () {
            return view('login');
    })->name('login');

    //Donor Login & Register Route
    Route::post('/donor/login', 'DonorAuth\LoginController@login');
    Route::get('/donor/register', 'DonorAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/donor/register', 'DonorAuth\RegisterController@register');

    //Donor Reset Password Route
    Route::get('/donor/password/reset', 'DonorAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/donor/password/reset/{token}', 'DonorAuth\ResetPasswordController@showResetForm');
    Route::post('/donor/password/email', 'DonorAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/donor/password/reset', 'DonorAuth\ResetPasswordController@reset')->name('password.email');

    //Staff Login Route
    Route::post('/staff/login', 'StaffAuth\LoginController@login');

    //Staff Reset Password Route
    Route::post('/staff/password/email', 'StaffAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/staff/password/reset', 'StaffAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/staff/password/reset', 'StaffAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/staff/password/reset/{token}', 'StaffAuth\ResetPasswordController@showResetForm');
});

//Donor Routes grouped under "/donor/..."
Route::group(['prefix' => 'donor', 'middleware' => ['web', 'auth:donor']], function () {

    //Homepage
    Route::get('/home', 'DonorControllers\EventController@indexShort');

    //Logout
    Route::post('/logout', 'DonorAuth\LoginController@logout')->name('logout');

    //Donor profile view, edit and deactivate
    Route::get('/profile', 'DonorControllers\DonorController@edit');
    Route::post('/profile', 'DonorControllers\DonorController@update');
    Route::post('/profile/password', 'DonorControllers\DonorController@changePassword');
    Route::post('/profile/deactivate', 'DonorControllers\DonorController@deactivate');

    //Upcoming events and booking of events
    Route::get('/upcoming-events', 'DonorControllers\EventController@index');
    Route::get('/upcoming-events/{id}', 'DonorControllers\EventController@show');
    Route::post('{id}/reserve', 'DonorControllers\ReservationController@store');

    //Reservation
    Route::get('/reservation', 'DonorControllers\ReservationController@index');
    Route::get('/reservation/current', 'DonorControllers\ReservationController@resvCurrent');
    Route::get('/reservation/{id}', 'DonorControllers\ReservationController@show');
    Route::post('/reservation/{id}/cancel', 'DonorControllers\ReservationController@deactivate');

    //Donor blood donation
    Route::get('/donation', 'DonorControllers\DonorHistoryController@index');
    Route::get('/donation/{id}/detail', 'DonorControllers\DonorHistoryController@show');

    //Fallback route for 404 error
    Route::fallback(function(){
        return response()->view('errors.404', [], 404);
    });
});

//HR Manager Routes grouped under "/staff/hr/..."
Route::group(['prefix' => 'staff/hr', 'middleware' => ['web', 'auth:staff', 'HRStaff']], function () {

    //Homepage
    Route::get('/home', 'StaffControllers\StaffEventController@indexShort');

    //Logout
    Route::post('/logout', 'StaffAuth\LoginController@logout')->name('logout');

    //Staff profile view, edit and deactivate
    Route::get('/profile', 'StaffControllers\StaffController@edit');
    Route::post('/profile', 'StaffControllers\StaffController@update');
    Route::post('/profile/password', 'StaffControllers\StaffController@changePassword');
    Route::post('/profile/deactivate', 'StaffControllers\StaffController@deactivate');

    /***** REGISTER SECTION *****/
    //Staff Register
    Route::get('/registration', 'StaffControllers\StaffEventController@create')->name('register');
    Route::post('/registration', 'StaffAuth\RegisterController@register');

    //Event Register
    Route::post('/registration/event', 'StaffControllers\StaffEventController@store');

    //Room register
    Route::post('/registration/room', 'StaffControllers\StaffRoomController@store');

    /***** LIST SECTION *****/
    Route::get('/list/donor', 'StaffControllers\StaffDonorController@index');
    Route::get('/list/donor/{id}', 'StaffControllers\StaffDonorController@show');

    Route::get('/list/staff', 'StaffControllers\StaffController@index');
    Route::get('/list/staff/{id}', 'StaffControllers\StaffController@show');
    Route::post('/list/staff/{id}', 'StaffControllers\StaffController@updateHR');
    Route::post('/list/staff/{id}/deactivate', 'StaffControllers\StaffController@deactivateHR');

    Route::get('/list/event', 'StaffControllers\StaffEventController@index');
    Route::get('/list/event/{id}', 'StaffControllers\StaffEventController@show');
    Route::post('/list/event/{id}', 'StaffControllers\StaffEventController@update');
    Route::post('/list/event/{id}/cancel', 'StaffControllers\StaffEventController@deactivate');

    Route::get('/dashboard', 'StaffControllers\ReportController@index');

    //Reports route
    //Exception Report
    Route::get('/report/exception', 'StaffControllers\ReportController@exceptionReportIndex');
    Route::post('/report/exception', 'StaffControllers\ReportController@exceptionReportProcessForm');
    Route::get('/report/exception/{id}', 'StaffControllers\ReportController@exceptionReport');
    Route::get('/report/exception/{id}/print', 'StaffControllers\ReportController@exceptionReportPrint');

    //Transaction Report
    Route::get('/report/transaction', 'StaffControllers\ReportController@transactionReportIndex');
    Route::post('/report/transaction/', 'StaffControllers\ReportController@transactionReportProcessForm');
    Route::get('/report/transaction/{id}', 'StaffControllers\ReportController@transactionReport');
    Route::get('/report/transaction/{id}/print', 'StaffControllers\ReportController@transactionReportPrint');

    //Summary Report
    Route::get('/report/summary', 'StaffControllers\ReportController@summaryReportIndex');
    Route::post('/report/summary', 'StaffControllers\ReportController@summaryReportProcessForm');
    Route::get('/report/summary/{year}/{rType}', 'StaffControllers\ReportController@summaryReport');
    Route::get('/report/summary/{year}/{rType}/print', 'StaffControllers\ReportController@summaryReportPrint');

    //Fallback route for 404 error
    Route::fallback(function(){
        return response()->view('errors.404', [], 404);
    });
});

//Nurse Routes grouped under "/staff/nurse/..."
Route::group(['prefix' => 'staff/nurse', 'middleware' => ['web', 'auth:staff', 'NurseStaff']], function () {

    //Homepage
    Route::get('/home', 'StaffControllers\StaffEventController@indexShort');

    //Logout
    Route::post('/logout', 'StaffAuth\LoginController@logout')->name('logout');

    //Profile view, edit and deactivate
    Route::get('/profile', 'StaffControllers\StaffController@edit');
    Route::post('/profile', 'StaffControllers\StaffController@update');
    Route::post('/profile/password', 'StaffControllers\StaffController@changePassword');
    Route::post('/profile/deactivate', 'StaffControllers\StaffController@deactivate');

    /***** LIST SECTION *****/
    Route::get('/schedule', 'StaffControllers\StaffScheduleController@index');
    Route::get('/schedule/{id}', 'StaffControllers\StaffScheduleController@show');
    Route::get('/schedule-history', 'StaffControllers\StaffScheduleController@schedHistory');
    Route::get('/schedule-history/{id}', 'StaffControllers\StaffScheduleController@showHistory');

    /***** MANAGE BLOOD SECTION *****/
    Route::get('/event/{id}/manage-blood', 'StaffControllers\BloodController@create');
    Route::post('/event/{id}/manage-blood', 'StaffControllers\BloodController@store');
    Route::post('/event/{id}/conclude', 'StaffControllers\ConcludeEventController@update');

    //Fallback route for 404 error
    Route::fallback(function(){
        return response()->view('errors.404', [], 404);
    });
});
