<?php



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(["prefix"=>"login"],function(){
    Route::get('magic', [ 'as' => 'login/magic', 'uses' => 'Auth\MagicLoginController@show']);
    Route::post('magic', [ 'as' => 'login/magic', 'uses' => 'Auth\MagicLoginController@sendToken']);
    Route::get ('magic/{token}', [ 'as' => 'login/magic/{token}', 'uses' => 'Auth\MagicLoginController@validateToken']);
    Route::get('smsLogin', ['as' => 'login/smsLogin', 'uses' => 'Auth\SmsLoginController@show']);
    Route::post('smsLogin', ['as' => 'login/smsLogin', 'uses' => 'Auth\SmsLoginController@sendCode']);
    Route::get('choice', 'Auth\LoginRedirectController@get_choice')->name('login/choice');
    Route::post('choice', 'Auth\LoginRedirectController@post_choice')->name('login/choice');


});


Route::get('code', 'Auth\LoginRedirectController@codes')->name('code');
Route::post('code', ['as' => 'code', 'uses' => 'Auth\LoginRedirectController@controlCode']);


