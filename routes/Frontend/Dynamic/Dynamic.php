<?php
Route::group(['middleware' => ["web","auth"] ], function () {
  	Route::get('/', 'App\Http\Controllers\Frontend\Pages\PagesController@index')->name('frontend.index');
});

Route::group(['middleware' => ["web","auth"] ], function () {
  	Route::get('/tester', 'App\Http\Controllers\Frontend\Pages\PagesController@index')->name('frontend.index.tester');
});

