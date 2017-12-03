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

Route::post('/email/all', 'EmailController@allEmailCompany')->middleware('closeapi');
Route::post('/email/info', 'EmailController@statusEmail')->middleware('closeapi');
Route::resource('email', 'EmailController')->middleware('closeapi');

Route::post('/sms/all', 'SmsController@allSmsCompany')->middleware('closeapi');
Route::post('/sms/info', 'SmsController@statusSms')->middleware('closeapi');
Route::resource('sms', 'SmsController')->middleware('closeapi');

Route::get('/access/valid/{token}', 'AccessController@isValid');
Route::resource('access', 'AccessController');


Route::resource('company', 'CompanyController');