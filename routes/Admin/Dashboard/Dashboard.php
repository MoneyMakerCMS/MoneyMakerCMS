<?php


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['web', 'auth', 'permission:view-admin']], function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard.index');
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard.index');
});
