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

Route::group(['prefix' => 'v1', 'namespace' => 'api'], function () {
    Route::post('auth/login', 'AuthController@login');
    Route::get('/', 'HolidaysController@show');

    Route::post('holidays_user/create', 'HolidaysController@create_user_holiday');
    Route::delete('holidays_user/delete/{id}', 'HolidaysController@delete_user_holiday');
    Route::post('holidays_user/update/{id}', 'HolidaysController@update_user_holiday');

    Route::post('holidays/favorite/{id}', 'HolidaysController@addToFavorite');
    Route::delete('holidays/favorite/{id}', 'HolidaysController@removeFromFavorite');

    Route::post('');
});