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


Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
  Route::get('/', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create', 'HomeController@create')->name('create');
Route::post('/createdoctor', 'HomeController@createdoctor');
Route::post('/getspecialist', 'HomeController@getspecialist');
Route::post('/getothermenulist', 'HomeController@getothermenulist');
Route::post('/getcity', 'HomeController@getcity');
Route::post('/getarea', 'HomeController@getarea');
Route::get('/onemenulist/{id}', 'HomeController@onemenulist');
Route::get('/onedoctor/{id}', 'HomeController@onedoctor');
Route::post('/contactus', 'HomeController@contactus');
Route::post('/sendsms', 'HomeController@sendsms');
Route::post('/addfee', 'HomeController@addfee');
Route::post('/createpatient', 'HomeController@createpatient');

Route::get('/facebook_login', 'HomeController@facebook_login');
Route::get('/facebook_callback', 'HomeController@facebook_callback');


/* Login */
Route::get('/resetpassword/{token}', 'LoginController@resetpassword');
Route::get('/verifyemail/{token}', 'LoginController@verifyemail');
Route::post('/resetnewpassword', 'LoginController@resetnewpassword');
Route::post('/accountlogin', 'LoginController@accountlogin');
Route::post('/forgotpassword', 'LoginController@forgotpassword');

/* Doctor */
Route::get('/logout', 'DoctorController@logout');
Route::get('/profile', 'DoctorController@index');
Route::post('/dgetspecialist', 'DoctorController@dgetspecialist');
Route::post('/dgetcity', 'DoctorController@dgetcity');
Route::post('/dgetarea', 'DoctorController@dgetarea');
Route::post('/updateprofile', 'DoctorController@updateprofile');
Route::post('/dsavechatone', 'DoctorController@dsavechatone');
Route::post('/dgetchat', 'DoctorController@dgetchat');
Route::get('/donemessage/{id}', 'DoctorController@donemessage');
Route::get('/dmessage', 'DoctorController@dmessage');
Route::get('/dendmessage', 'DoctorController@dendmessage');
Route::post('/dsetallstatus', 'DoctorController@dsetallstatus');
Route::get('/getdunreadmessage', 'DoctorController@getdunreadmessage');
Route::post('/dgivefeedback', 'DoctorController@givefeedback');


Route::get('/consultation', 'DoctorController@consultation');
Route::get('/dcontact', 'DoctorController@dcontact');
Route::post('/dcontactus', 'DoctorController@dcontactus');
Route::post('/addbankaccount', 'DoctorController@addbankaccount');
Route::get('/manage', 'DoctorController@manage');


/* Patient */

Route::get('/pprofile', 'PatientController@pprofile');
Route::post('/pupdateprofile', 'PatientController@pupdateprofile');
Route::get('/plogout', 'PatientController@plogout');
Route::get('/pcontact', 'PatientController@pcontact');
Route::get('/bank', 'DoctorController@bank');


Route::get('/pconsultation', 'PatientController@pconsultation');
Route::get('/ponemenulist/{id}', 'PatientController@ponemenulist');
Route::get('/ponedoctor/{id}', 'PatientController@ponedoctor');
Route::get('/createmessage/{id}', 'PatientController@createmessage');
Route::get('/createunmessage/{id}', 'PatientController@createunmessage');
Route::get('/addmoney', 'PatientController@addmoney');
Route::get('/pmessage', 'PatientController@pmessage');
Route::get('/changepassword', 'PatientController@changepassword');
Route::post('/ppassword', 'PatientController@ppassword');
Route::get('/pcontact', 'PatientController@pcontact');
Route::post('/pcontactus', 'PatientController@pcontactus');
Route::post('/addmoneyaccount', 'PatientController@addmoneyaccount');
Route::post('/psavechatone', 'PatientController@psavechatone');
Route::post('/pgetchat', 'PatientController@pgetchat');
Route::get('/onemessage/{id}', 'PatientController@onemessage');
Route::get('/getpunreadmessage', 'PatientController@getpunreadmessage');
Route::post('/psetallstatus', 'PatientController@psetallstatus');
Route::post('/givefeedback', 'PatientController@givefeedback');