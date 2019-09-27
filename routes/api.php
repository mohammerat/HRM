<?php

Route::middleware('api')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
});

Route::middleware('auth:api')->group(function () {
    Route::get('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');

    # Users Route
    Route::get('user', 'UsersController@info');
    Route::get('users', 'UsersController@show')->middleware('permission:read users');
    Route::get('users/{id}', 'UsersController@edit')->middleware('permission:read users');
    Route::post('users/create', 'UsersController@store')->middleware('permission:create user');
    Route::put('users/{id}', 'UsersController@update')->middleware('permission:update user');
    Route::delete('users/{id}', 'UsersController@delete')->middleware('permission:delete user');

    # Rule CRUD Routes
    Route::post('work_hours', 'WorkHoursController@store')->middleware('permission:create work hour');
    Route::put('work_hours', 'WorkHoursController@store')->middleware('permission:create work hour');

    Route::post('salaries', 'SalaryController@store')->middleware('permission:create salary');
    Route::put('salaries', 'SalaryController@store')->middleware('permission:create salary');


    # Demand CRUD Routes
    Route::get('demands', 'DemandsController@index');

    Route::post('demands/create', 'DemandsController@create')->middleware('permission:create demand');
    Route::post('demands/{id}', 'DemandsController@update')->middleware('permission:update demand');
    Route::get('demands/{id}', 'DemandsController@demand_visit_by_supervisor')->middleware('permission:update demand');

    Route::post('dismissal/create', 'DemandsController@create_dismissal')->middleware('permission:create dismissal');
    Route::post('dismissal/{id}', 'DemandsController@update_dismissal')->middleware('permission:update dismissal');
    Route::get('dismissal/{id}', 'DemandsController@dismissal_visit_by_supervisor')->middleware('permission:update dismissal');


    # Attendance CRUD Routes
    Route::post('attendance', 'AttendancesController@store')->middleware('permission:create attendance');
    Route::post('attendance/month/all', 'AttendancesController@this_month')->middleware('permission:update attendance');
});
