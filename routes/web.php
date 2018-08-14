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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/magic', [ 'as' => 'login/magic', 'uses' => 'Auth\MagicLoginController@show']);
Route::post('login/magic', [ 'as' => 'login/magic', 'uses' => 'Auth\MagicLoginController@sendToken']);
Route::get ('login/magic/{token}', [ 'as' => 'login/magic/{token}', 'uses' => 'Auth\MagicLoginController@validateToken']);

//Route::get('login/smsLogin', [ 'as' => 'login/smsLogin', 'uses' => 'Auth\SmsLoginController@show']);

//Route::post('login/smsLogin', [ 'as' => 'login/smsLogin', 'uses' => 'Auth\SmsLoginController@sendCode']);





