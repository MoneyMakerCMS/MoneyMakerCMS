{!! '<' . '?' . 'p' . 'h' . 'p' !!}
@foreach($pages as $page)
Route::group(['middleware' => [{!!$page->page_middleware!!}] ], function () {
  	Route::get('{{$page->uri}}', 'Ninjaparade\Pages\Http\Controllers\Frontend\PagesController@index')->name('{{$page->route}}');
});
@endforeach