<?php


Route::group(['prefix' => 'content', 'namespace' => 'Content'], function () {
    Route::get('/', 'ContentController@index')->name('admin.content.index');
    Route::get('/get', 'ContentController@get')->name('admin.content.get');
    Route::get('create', 'ContentController@create')->name('admin.content.create');
    Route::post('create', 'ContentController@store')->name('admin.content.store');
    Route::get('{id}/show', 'ContentController@show')->name('admin.content.show');
    Route::get('{id}/edit', 'ContentController@edit')->name('admin.content.edit');
    Route::post('{id}/edit', 'ContentController@update')->name('admin.content.update');
    Route::delete('{id}/destroy', 'ContentController@destroy')->name('admin.content.destroy');
});
