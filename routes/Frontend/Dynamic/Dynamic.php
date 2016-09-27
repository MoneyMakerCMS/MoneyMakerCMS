<?php

Route::group(['namespace' => 'Frontend\Pages', 'middleware' => ['web']], function () {
    Route::get('/', 'PagesController@index')->name('frontend.index');
});

Route::group(['namespace' => 'Frontend\Pages', 'middleware' => ['web', 'auth']], function () {
    Route::get('another-test', 'PagesController@index')->name('frontend.faq');
});
