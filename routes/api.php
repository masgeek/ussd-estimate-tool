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


//load projects
Route::post('/ussd', 'USSDController@handleUSSD');
//load projects
Route::post('/ussd1', 'USSDV2Controller@handleUSSD');
