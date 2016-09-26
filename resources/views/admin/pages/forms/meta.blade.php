<div style="padding-top:40px;"></div>
{!! BootForm::text('Title', 'title')->value(old('title', $seo->title))->attribute('id', 'title') !!}

{!! BootForm::text('Description', 'description')->value(old('description', $seo->description))->attribute('id', 'description') !!}

{!! BootForm::text('Keywords', 'keywords')->value(old('keywords', $seo->keywords))->attribute('id', 'keywords') !!}


{!! BootForm::select('Robots', 'robots')
	->options(
		[
			'index,follow' => 'index,follow', 
			'index,nofollow' => 'index,nofollow',
			'noindex,follow' => 'noindex,follow',
			'noindex,nofollow' => 'noindex,nofollow',
		]
	)
	->attribute('id', 'robots') 
	->select(old('robots', $seo->robots));
!!}