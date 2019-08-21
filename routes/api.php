<?php

Route::middleware('api')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::get('test', function () {
        return response('Nothing');
    });
});

Route::middleware('auth:api')->group(function () {
    Route::get('logout', 'AuthController@logout');
    Route::get('user', 'UsersController@show');
    Route::get('salary', 'SalaryController@show');
});
