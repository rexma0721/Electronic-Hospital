<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/doctor_login', 'DoctorAppController@doctor_login');
Route::post('/doctor_online', 'DoctorAppController@doctor_online');
Route::post('/doctor_offline', 'DoctorAppController@doctor_offline');
Route::post('/doctor_password', 'DoctorAppController@doctor_password');
Route::post('/doctor_home', 'DoctorAppController@doctor_home');
Route::post('/doctor_money', 'DoctorAppController@doctor_money');
Route::post('/doctor_consultation', 'DoctorAppController@doctor_consultation');
Route::post('/doctor_withdraw', 'DoctorAppController@doctor_withdraw');
Route::post('/doctor_history', 'DoctorAppController@doctor_history');
Route::post('/doctor_profile', 'DoctorAppController@doctor_profile');
Route::post('/doctor_profile_update', 'DoctorAppController@doctor_profile_update');
Route::post('/doctor_photo_update', 'DoctorAppController@doctor_photo_update');
Route::post('/doctor_attached', 'DoctorAppController@doctor_attached');
Route::post('/get_notification', 'DoctorAppController@get_notification');
Route::post('/read_notification', 'DoctorAppController@read_notification');
Route::post('/doctor_sendNotification', 'DoctorAppController@doctor_sendNotification');
Route::post('/forgotpassword', 'DoctorAppController@forgotpassword');
Route::post('/patient_login', 'PatientAppController@patient_login');
Route::post('/patient_verify', 'PatientAppController@patient_verify');
Route::post('/patient_register', 'PatientAppController@patient_register');
Route::post('/patient_menulist', 'PatientAppController@patient_menulist');
Route::post('/patient_doctor', 'PatientAppController@patient_doctor');
Route::post('/patient_photo_update', 'PatientAppController@patient_photo_update');
Route::post('/patient_money', 'PatientAppController@patient_money');
Route::post('/patient_password', 'PatientAppController@patient_password');
Route::post('/patient_consultation', 'PatientAppController@patient_consultation');
Route::post('/patient_alldoctors', 'PatientAppController@patient_alldoctors');
Route::post('/patient_home', 'PatientAppController@patient_home');
Route::post('/patient_profile', 'PatientAppController@patient_profile');
Route::post('/patient_profile_update', 'PatientAppController@patient_profile_update');
Route::post('/patient_addmoney', 'PatientAppController@patient_addmoney');
Route::post('/patient_givefeedback', 'PatientAppController@patient_givefeedback');
Route::post('/patient_givefeedbacks', 'PatientAppController@patient_givefeedbacks');
Route::post('/patient_startConsultant', 'PatientAppController@patient_startConsultant');
Route::post('/patient_attached', 'PatientAppController@patient_attached');
Route::post('/contactus', 'PatientAppController@contactus');
Route::post('/patientgetlist', 'PatientAppController@patientgetlist');
Route::post('/patient_login_social', 'PatientAppController@patient_login_social');
Route::post('/addbank', 'DoctorAppController@addbank');
Route::post('/changeprice', 'DoctorAppController@changeprice');

Route::post('/patient_sendNotification', 'PatientAppController@patient_sendNotification');

