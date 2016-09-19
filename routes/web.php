<?php

require(__DIR__ . '/Admin/Users/Users.php');
require(__DIR__ . '/Admin/Dashboard/Dashboard.php');

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
