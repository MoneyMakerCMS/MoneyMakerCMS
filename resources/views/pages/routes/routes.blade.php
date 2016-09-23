{!! '<'.'?php' !!}
@foreach($pages as $page)
Route::group(['middleware' => [{!!$page->page_middleware!!}] ], function () {
  	Route::get('{{$page->uri}}', 'App\Http\Controllers\Frontend\Pages\PagesController@index')->name('{{$page->route}}');
});

@endforeach