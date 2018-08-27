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
//login ile başlayanları group yaparak düzenle
Route::get('login/magic', [ 'as' => 'login/magic', 'uses' => 'Auth\MagicLoginController@show']);
Route::post('login/magic', [ 'as' => 'login/magic', 'uses' => 'Auth\MagicLoginController@sendToken']);
Route::get ('login/magic/{token}', [ 'as' => 'login/magic/{token}', 'uses' => 'Auth\MagicLoginController@validateToken']);
Route::get('login/smsLogin', ['as' => 'login/smsLogin', 'uses' => 'Auth\SmsLoginController@show']);
Route::post('login/smsLogin', ['as' => 'login/smsLogin?XDEBUG_SESSION_START=XDEBUG_SESSION', 'uses' => 'Auth\SmsLoginController@sendCode']);


Route::get('code', 'Auth\SmsLoginController@codes')->name('code');
Route::post('code', ['as' => 'code', 'uses' => 'Auth\SmsLoginController@controlCode']);


Route::get('login/choice', 'Auth\LoginRedirectController@get_choice')->name('login/choice');
Route::post('login/choice', 'Auth\LoginRedirectController@post_choice')->name('login/choice');
