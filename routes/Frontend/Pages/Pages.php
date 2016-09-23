<?php
Route::group(['middleware' => ["web","auth"] ], function () {
  	Route::get('/', 'Ninjaparade\Pages\Http\Controllers\Frontend\PagesController@index')->name('frontend.index');
});