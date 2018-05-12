<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Authentication
 */
Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
});

Route::middleware(['jwt.auth'])->group(function () {

    /**
     * User
     */
    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@index')->middleware('can:user-index,user');
        Route::get('/{id}', 'UserController@show')->middleware('can:user-show,user');
        Route::post('/', 'UserController@store')->middleware('can:user-store,user');
        Route::put('/{id}', 'UserController@update')->middleware('can:user-update,user');
        Route::put('/{id}/group/assign/{name}', 'UserController@assignGroup')->middleware('can:user-assign-group,user');
        Route::put('/{id}/group/revoke/{name}', 'UserController@revokeGroup')->middleware('can:user-revoke-group,user');
        Route::put('/{id}/password-reset', 'UserController@passwordReset')->middleware('can:user-password-reset,user');
        Route::delete('/{id}', 'UserController@destroy')->middleware('can:user-update,user');
    });

    /**
     * Dept
     */
    Route::prefix('dept')->group(function () {
        Route::get('/', 'DeptController@index')->middleware('can:dept-index,dept');
        Route::get('/{id}', 'DeptController@show')->middleware('can:dept-show,dept');
        Route::post('/', 'DeptController@store')->middleware('can:dept-store,dept');
        Route::put('/{id}', 'DeptController@update')->middleware('can:dept-update,dept');
        Route::delete('/{id}', 'DeptController@destroy')->middleware('can:dept-update,dept');
    });

    /**
     * Employee
     */
    Route::prefix('employee')->group(function () {
        Route::get('/', 'EmployeeController@index')->middleware('can:employee-index,employee');
        Route::get('/{id}', 'EmployeeController@show')->middleware('can:employee-show,employee');
        Route::post('/', 'EmployeeController@store')->middleware('can:employee-store,employee');
        Route::post('/upload-photo', 'EmployeeController@uploadPhoto')->middleware('can:employee-upload-photo,employee');
        Route::put('/{id}', 'EmployeeController@update')->middleware('can:employee-update,employee');
        Route::delete('/{id}', 'EmployeeController@destroy')->middleware('can:employee-destroy,employee');
    });

    /**
     * Group
     */
    Route::prefix('group')->group(function () {
        Route::get('/', 'GroupController@index')->middleware('can:group-index,group');
        Route::get('/{id}', 'GroupController@show')->middleware('can:group-show,group');
        Route::post('/', 'GroupController@store')->middleware('can:group-store,group');
        Route::put('/{id}', 'GroupController@update')->middleware('can:group-update,group');
        Route::put('/{id}/users', 'GroupController@updateUsers')->middleware('can:group-update-users,group');
        Route::put('{id}/privileges-update', 'GroupController@updatePrivileges')->middleware('can:group-update-privileges,group');
        Route::put('/{id}/privilege/add/{name}', 'GroupController@addPrivilege')->middleware('can:group-add-privilege,group');
        Route::put('/{id}/privilege/remove/{name}', 'GroupController@removePrivilege')->middleware('can:group-remove-privilege,group');
        Route::delete('/{id}', 'GroupController@destroy')->middleware('can:group-destroy,group');
    });

    /**
     * Position
     */
    Route::prefix('position')->group(function () {
        Route::get('/', 'PositionController@index')->middleware('can:position-index,position');
        Route::get('/{id}', 'PositionController@show')->middleware('can:position-show,position');
        Route::post('/', 'PositionController@store')->middleware('can:position-store,position');
        Route::put('/{id}', 'PositionController@update')->middleware('can:position-update,position');
        Route::delete('/{id}', 'PositionController@destroy')->middleware('can:position-destroy,position');
    });

    /**
     * Privilege
     */
    Route::prefix('privilege')->group(function () {
        Route::get('/', 'PrivilegeController@index')->middleware('can:privilege-index,privilege');
        Route::get('/{id}', 'PrivilegeController@show')->middleware('can:privilege-show,privilege');
        Route::post('/', 'PrivilegeController@store')->middleware('can:privilege-store,privilege');
        Route::put('/{id}', 'PrivilegeController@update')->middleware('can:privilege-update,privilege');
        Route::delete('/{id}', 'PrivilegeController@destroy')->middleware('can:privilege-destroy,privilege');
    });

});
