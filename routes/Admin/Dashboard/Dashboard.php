<?php
Route::group(['namespace' => 'Dashboard'], function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard.index');
 	Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard.index');
});
