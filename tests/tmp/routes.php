<?php

Route::group(['namespace' => 'Frontend\Pages', 'middleware' => ["web","auth"] ], function () {
  	Route::get('test-page', 'PagesController@index')->name('frontend.test-page');
});

