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
Route::auth();
Route::get('logout', 'Auth\LoginController@logout');
Route::post('reset', ['as' => 'reset', 'uses' => 'Auth\ForgotPasswordController@reset']);
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [
        'as' => 'home',
        'uses' => 'ProjectController@index'
    ]);
    Route::group(['prefix' => 'profile'], function() {
       Route::get('/', [
           'as' => 'profile',
           'uses' => 'ProfileController@index'
       ]);
       Route::post('/', [
           'as' => 'update.profile',
           'uses' => 'ProfileController@update'
       ]);
    });
    Route::get('users/load-popup', [
        'middleware' => 'ajax',
        'uses' => 'UserController@loadPopup'
    ]);
    Route::post('users/update-password/{id}', [
        'as' => 'users.updatePassword',
        'uses' => 'UserController@updatePassword'
    ]);
    Route::resource('users', 'UserController');
});
