<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => ['web']], function () {

    //Route::auth();
    Route::get('admin/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm']);
    Route::post('admin/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']);
    Route::get('admin/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);

    Route::group(['prefix' => 'admin', 'middleware' => ['auth'] ], function () {
        Route::get('/', 'AdminController@index');
        Route::resource('users/administrator', 'AdminController@users_administrator');
        Route::resource('users/roles', 'AdminController@users_roles');
        // Admin APIs
        Route::resource('users/api/administrator', 'UsersAdministratorController');
        Route::resource('users/api/roles', 'UsersRolesController');

    });






});
