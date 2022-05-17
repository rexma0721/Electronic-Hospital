<?php

Route::get('/home', 'Admin\HomeController@index')->name('home');

/**
 * ROLES
 */
 Route::get('/role/{role}/permissions','Admin\RoleController@permissions');
 Route::get('/rolePermissions','Admin\RoleController@rolePermissions')->name('myrolepermission');
 Route::get('/roles/all','Admin\RoleController@all');
 Route::post('/assignPermission','Admin\RoleController@attachPermission');
 Route::post('/detachPermission','Admin\RoleController@detachPermission');
 Route::resource('/roles','Admin\RoleController');

 /**
  * PERMISSIONs
  */
 Route::get('/permissions/all','Admin\PermissionController@all');
 Route::resource('/permissions','Admin\PermissionController');


 /**
 * ADMINs
 */
Route::get('/profile','Admin\AdminController@profileEdit');
Route::put('/profile/{admin}','Admin\AdminController@profileUpdate');
Route::put('/changepassword/{admin}','Admin\AdminController@changePassword');
Route::put('/administrator/status','Admin\AdminController@switchStatus');
Route::post('/administrator/removeBulk','Admin\AdminController@destroyBulk');
Route::put('/administrator/statusBulk','Admin\AdminController@switchStatusBulk');
Route::resource('/administrator','Admin\AdminController');

/**
 * USERS
 */
Route::put('/user/status','Admin\UserController@switchStatus');
Route::post('/user/removeBulk','Admin\UserController@destroyBulk');
Route::put('/user/statusBulk','Admin\UserController@switchStatusBulk');
Route::get('/user/{id}/cellar','Admin\UserController@showUserCellar');
Route::resource('/user','Admin\UserController');

Route::get('/consultant', 'Admin\HomeController@consultant');

/******/
Route::post('/changefee', 'Admin\HomeController@changefee');

Route::get('/newdoctor', 'Admin\HomeController@newdoctor');
Route::get('/listdoctor', 'Admin\HomeController@listdoctor');
Route::post('/editDoctor', 'Admin\HomeController@editDoctor');
Route::post('/editPrice', 'Admin\HomeController@editPrice');
Route::post('/approvedoctor', 'Admin\HomeController@approvedoctor');
Route::post('/declinedoctor', 'Admin\HomeController@declinedoctor');
Route::post('/balancedoctor', 'Admin\HomeController@balancedoctor');

Route::get('/menulist', 'Admin\HomeController@menulist');
Route::post('/newmenulist', 'Admin\HomeController@newmenulist');
Route::post('/editmenulist', 'Admin\HomeController@editmenulist');
Route::get('/deletemenulist/{id}', 'Admin\HomeController@deletemenulist');

Route::get('/specialist', 'Admin\HomeController@specialist');
Route::post('/newspecialist', 'Admin\HomeController@newspecialist');
Route::post('/editspecialist', 'Admin\HomeController@editspecialist');
Route::get('/deletespecialist/{id}', 'Admin\HomeController@deletespecialist');

Route::get('/definition', 'Admin\HomeController@definition');
Route::post('/newdefinition', 'Admin\HomeController@newdefinition');
Route::post('/editdefinition', 'Admin\HomeController@editdefinition');
Route::get('/deletedefinition/{id}', 'Admin\HomeController@deletedefinition');

Route::get('/degree', 'Admin\HomeController@degree');
Route::post('/newdegree', 'Admin\HomeController@newdegree');
Route::post('/editdegree', 'Admin\HomeController@editdegree');
Route::get('/deletedegree/{id}', 'Admin\HomeController@deletedegree');

Route::get('/country', 'Admin\HomeController@country');
Route::post('/newcountry', 'Admin\HomeController@newcountry');
Route::post('/editcountry', 'Admin\HomeController@editcountry');
Route::get('/deletecountry/{id}', 'Admin\HomeController@deletecountry');

Route::get('/city', 'Admin\HomeController@city');
Route::post('/newcity', 'Admin\HomeController@newcity');
Route::post('/editcity', 'Admin\HomeController@editcity');
Route::get('/deletecity/{id}', 'Admin\HomeController@deletecity');

Route::get('/area', 'Admin\HomeController@area');
Route::post('/newarea', 'Admin\HomeController@newarea');
Route::post('/editarea', 'Admin\HomeController@editarea');
Route::get('/deletearea/{id}', 'Admin\HomeController@deletearea');

Route::get('/contact', 'Admin\HomeController@contact');
Route::get('/deletecontact/{id}', 'Admin\HomeController@deletecontact');

Route::get('/dcontact', 'Admin\HomeController@dcontact');
Route::get('/deletedcontact/{id}', 'Admin\HomeController@deletedcontact');


Route::post('/saveconnectcube', 'Admin\HomeController@saveconnectcube');
Route::get('/bank', 'Admin\HomeController@bank');
