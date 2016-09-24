<?php

/*
* Admin Routes
*/

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['web', 'auth']], function () {
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

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

/*
* Dynamic routes file created from pages
*/
require __DIR__.'/Frontend/Dynamic/Dynamic.php';
