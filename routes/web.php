<?php

/*
* Admin Routes
*/

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::group(['middleware' => ['permission:view-admin']], function () {
        require __DIR__.'/Admin/Dashboard/Dashboard.php';
    });
    require __DIR__.'/Admin/Users/Users.php';
    require __DIR__.'/Admin/Roles/Roles.php';
    require __DIR__.'/Admin/Content/Content.php';
    require __DIR__.'/Admin/Pages/Pages.php';
});


/*
* Frontend Routes
*/

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'WelcomeController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

/*
* Dynamic routes file created from pages
*/
require app('dynamic_routes_path');
