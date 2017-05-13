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

//AUTH ROUTES
Route::auth();
Route::get('logout', 'Auth\LoginController@logout');
Route::post('reset', ['as' => 'reset', 'uses' => 'Auth\ForgotPasswordController@reset']);
//END AUTH ROUTES


Route::group(['middleware' => 'auth'], function() {

//    PROJECT ROUTES
    Route::get('/', [
        'as' => 'home',
        'uses' => 'ProjectController@index'
    ]);
    Route::resource('project', 'ProjectController', [
        'except' => ['delete', 'update', 'edit', 'create']
    ]);
    Route::post('project/{id}/share', [
        'as' => 'project.share',
        'uses' => 'ProjectController@share',
        'middleware' => 'ajax'
    ]);
    Route::post('project/{id}/share/store', [
        'as' => 'project.share.store',
        'uses' => 'ProjectController@storeShare',
        'middleware' => 'ajax'
    ]);
    Route::get('projects/load-create', [
        'as' => 'project.load.create',
        'uses' => 'ProjectController@loadCreate',
        'middleware' => 'ajax'
    ]);
//    END PROJECT ROUTES


//    PROFILE ROUTES
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
//    END PROFILE ROUTES

//    USER ROUTES
    Route::get('users/load-popup', [
        'middleware' => 'ajax',
        'uses' => 'UserController@loadPopup'
    ]);
    Route::post('users/update-password/{id}', [
        'as' => 'users.updatePassword',
        'uses' => 'UserController@updatePassword'
    ]);
    Route::resource('users', 'UserController', [
        'except' => ['create', 'show', 'edit']
    ]);
//    END USER ROUTES


//    TASKS
    Route::group(['prefix' => 'task'], function() {
        Route::post('take/{id}', [
            'as' => 'task.take',
            'uses' => 'TaskController@take'
        ]);
        Route::post('end/{id}', [
            'as' => 'task.end',
            'uses' => 'TaskController@end'
        ]);
        Route::post('close/{id}', [
            'as' => 'task.close',
            'uses' => 'TaskController@close'
        ]);
    });
    Route::get('task/load-delete', [
        'uses' => 'TaskController@loadDelete',
        'middleware' => 'ajax'
    ]);
    Route::resource('task', 'TaskController', [
        'except' => ['create', 'index', 'show', 'edit']
    ]);
//    END TASKS ROUTES
});
