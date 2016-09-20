<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['web', 'auth'] ], function () {
    Route::group(['middleware' => ['permission:view-admin']], function () {
        require(__DIR__ . '/Admin/Dashboard/Dashboard.php');
    });
    require(__DIR__ . '/Admin/Users/Users.php');
    require(__DIR__ . '/Admin/Roles/Roles.php');
    require(__DIR__ . '/Admin/Content/Content.php');
});


Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
