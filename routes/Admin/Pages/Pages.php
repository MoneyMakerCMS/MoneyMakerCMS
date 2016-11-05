<?php


Route::group(['prefix' => 'pages', 'namespace' => 'Pages'], function () {
    Route::get('/', 'PagesController@index')->name('admin.pages.index');
    Route::get('/get', 'PagesController@get')->name('admin.pages.get');
    Route::get('create', 'PagesController@create')->name('admin.pages.create');
    Route::post('create', 'PagesController@store')->name('admin.pages.store');
    Route::get('{id}/show', 'PagesController@show')->name('admin.pages.show');
    Route::get('{id}/edit', 'PagesController@edit')->name('admin.pages.edit');
    Route::post('{id}/edit', 'PagesController@update')->name('admin.pages.update');
    Route::delete('{id}/destroy', 'PagesController@destroy')->name('admin.pages.destroy');
});
