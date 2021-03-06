<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'ChatController@index');
Route::get('/chat', 'ChatController@get');
Route::post('/chat', 'ChatController@post');

Route::get('/auth', 'AuthController@get');
Route::post('/auth', 'AuthController@post');
