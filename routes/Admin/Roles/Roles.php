<?php 


Route::group(['prefix' => 'roles', 'namespace' => 'Roles'], function () {
    Route::get('/', 'RolesController@index')->name('admin.roles.index');
    Route::get('/get', 'RolesController@get')->name('admin.roles.get');
    Route::get('create', 'RolesController@create')->name('admin.roles.create');
    Route::post('create', 'RolesController@store')->name('admin.roles.store');
    Route::get('{id}/show', 'RolesController@show')->name('admin.roles.show');
    Route::get('{id}/edit', 'RolesController@edit')->name('admin.roles.edit');
    Route::post('{id}/edit', 'RolesController@update')->name('admin.roles.update');
    Route::post('{id}/destroy', 'RolesController@destroy')->name('admin.roles.destroy');
});