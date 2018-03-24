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

Route::get('/login', function () {
    return view('login');
});

Route::group(['prefix' => 'staff'], function () {
  Route::get('/login', 'StaffAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'StaffAuth\LoginController@login');
  Route::post('/logout', 'StaffAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'StaffAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'StaffAuth\RegisterController@register');

  Route::post('/password/email', 'StaffAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'StaffAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'StaffAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'StaffAuth\ResetPasswordController@showResetForm');
});


Route::group(['prefix' => 'donor'], function () {
  Route::get('/login', 'DonorAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'DonorAuth\LoginController@login');
  Route::post('/logout', 'DonorAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'DonorAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'DonorAuth\RegisterController@register');

  Route::post('/password/email', 'DonorAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'DonorAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'DonorAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'DonorAuth\ResetPasswordController@showResetForm');
});
