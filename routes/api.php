<?php

Route::middleware('api')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
});

Route::middleware('auth:api')->group(function () {
    Route::get('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    # Users Route
    Route::get('user', 'UsersController@info');
    Route::get('users', 'UsersController@show')->middleware('permission:read users');
    Route::get('users/{id}', 'UsersController@edit')->middleware('permission:read users');
    Route::post('users/create', 'UsersController@store')->middleware('permission:create user');
    Route::put('users/{id}', 'UsersController@update')->middleware('premission:update user');
    Route::delete('users/{id}', 'UsersController@delete')->middleware('permission:delete user');

    # Rule CRUD Routes


    # Demand CRUD Routes


    # Attendance CRUD Routes
});
