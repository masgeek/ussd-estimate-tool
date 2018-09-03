<?php


/*
|---------------------------------------------------------------------------------------------------------------------
| API Routes
|---------------------------------------------------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
|---------------------------------------------------------------------------------------------------------------------
| ROUTES UNDER THE API MIDDLEWARE
|---------------------------------------------------------------------------------------------------------------------
|
|
*/



#send reset password email
Route::post('/password/email', 'Auth\ForgotPasswordController@index');

#reset email
Route::post('/password/reset', 'Auth\ResetPasswordController@index');

#verify email
Route::get('/user/email/verify/{token}', 'Auth\EmailVerificationController@index');

//load filters
Route::get('/filter/list', 'FilterController@fetch');

//load projects
Route::get('/project/list', 'ProjectController@fetch');

//load projects
Route::post('/ussd', 'USSDController@handleUSSD');
