<?php 

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['web', 'auth'] ], function () {
    Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {
        Route::get('/', 'UsersController@index')->name('admin.users.index');
        Route::get('/get', 'UsersController@get')->name('admin.users.get');
        Route::get('create', 'UsersController@create')->name('admin.users.create');
        Route::post('create', 'UsersController@store')->name('admin.users.store');
        Route::get('{id}/show', 'UsersController@show')->name('admin.users.show');
        Route::get('{id}/edit', 'UsersController@edit')->name('admin.users.edit');
        Route::post('{id}/edit', 'UsersController@update')->name('admin.users.update');
        Route::post('{id}/destroy', 'UsersController@destroy')->name('admin.users.destroy');
    });
});