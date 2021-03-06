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
    Route::post('user/settings', 'UsersController@settings');
    Route::get('user/settings', 'UsersController@showSettings');
    Route::post('user/push_token', 'UsersController@pushTokenUpdate');

    Route::get('categories', 'HolidaysController@categories');
    Route::get('categories/{category_id}', 'HolidaysController@categoryHolidays');

    Route::get('holidays/colors', 'HolidaysController@getColors');
    Route::post('holidays_user/create', 'HolidaysController@createUserHoliday');
    Route::delete('holidays_user/delete/{id}', 'HolidaysController@deleteUserHoliday');
    Route::post('holidays_user/update/{id}', 'HolidaysController@updateUserHoliday');
    Route::get('holidays_user/show', 'HolidaysController@showHolidays');
    Route::get('holidays_user/{id}', 'HolidaysController@showPrivateHoliday');

    Route::get('holiday/{id}', 'HolidaysController@Holiday');
    Route::post('holidays/favorite/{id}', 'HolidaysController@addToFavorite');
    Route::delete('holidays/favorite/{id}', 'HolidaysController@destroy');
    Route::get('holidays/random/{skip}', 'HolidaysController@showRandomHoliday');

    Route::get('holidays/today', 'HolidaysController@todayHolidays');
    Route::get('holidays/near', 'HolidaysController@nearHolidays');
    Route::get('holidays/search', 'HolidaysController@searchHolidays');
    Route::get('holidays/month', 'HolidaysController@monthHolidays');
    Route::get('holidays/show_favorite', 'HolidaysController@showFavoriteHolidays');
});