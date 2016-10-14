{!! '<'.'?php' !!}

@foreach($pages as $page)
Route::group(['namespace' => 'Frontend\Pages', 'middleware' => [{!!$page->page_middleware!!}] ], function () {
  	Route::get('{{$page->uri}}', 'PagesController@index')->name('{{$page->route}}');
});

@endforeach