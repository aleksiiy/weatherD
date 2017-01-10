<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});


Auth::routes();


Route::group(['prefix' => 'admin' , 'namespace' => 'Admin'], function () {
    Route::get('/', 'MainController@index');

    Route::get('/category', 'MainController@category');
    Route::PATCH('/category_create', 'MainController@category_create');
    Route::get('/category/update/{id}', 'MainController@update');
    Route::post('/category/edit/{id}', 'MainController@edit');
    Route::get('/category/destroy/{id}', 'MainController@destroy');

    Route::get('/category/{id}', 'HolidayController@create');
    Route::PATCH('/category/{id}', 'HolidayController@save');

    Route::get('/holiday/update/{id}','HolidayController@updateHoliday');
    Route::post('/holiday/edit/{id}','HolidayController@editHoliday');
    Route::get('/holiday/destroy/{id}','HolidayController@destroyHoliday');

    Route::get('/show','HolidayController@show');
    Route::get('/description/{id}','HolidayController@description');

    Route::get('/send','HolidayController@sendPush');
});
Auth::routes();

Route::get('/home', 'HomeController@index');
