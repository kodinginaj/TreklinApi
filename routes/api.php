<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('all', 'AuthController@getAll');
Route::post('register', 'AuthController@register');
Route::post('registerOfficer', 'AuthController@registerOfficer');
Route::post('login', 'AuthController@login');
Route::post('loginOfficer', 'AuthController@loginOfficer');

//User
Route::get('user/getOfficer', 'UserController@getOfficer');
Route::post('user/userComplaint', 'UserController@userComplaint');
Route::get('user/getArticle', 'UserController@getArticle');
Route::post('user/getDetailArticle', 'UserController@getDetailArticle');

Route::post('user/insertArticle', 'UserController@insertArticle');

//Officer
Route::post('officer/getComplaintByIdOfficer', 'OfficerController@getComplaintByIdOfficer');
Route::post('officer/updateLocation', 'OfficerController@updateLocation');
