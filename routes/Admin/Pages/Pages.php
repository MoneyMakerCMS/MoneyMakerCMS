<?php


Route::group(['prefix' => 'pages', 'namespace' => 'Pages'], function () {
    Route::get('/', 'PageController@index')->name('admin.pages.index');
    Route::get('/get', 'PageController@get')->name('admin.pages.get');
    Route::get('create', 'PageController@create')->name('admin.pages.create');
    Route::post('create', 'PageController@store')->name('admin.pages.store');
    Route::get('{id}/show', 'PageController@show')->name('admin.pages.show');
    Route::get('{id}/edit', 'PageController@edit')->name('admin.pages.edit');
    Route::post('{id}/edit', 'PageController@update')->name('admin.pages.update');
    Route::delete('{id}/destroy', 'PageController@destroy')->name('admin.pages.destroy');
});
