
<input type="hidden" name="page_id" value="{{ $page->id ? : '' }}">

<fieldset style="padding-top:40px;">
	{!! BootForm::text('Page Name', 'name')->value(old('name', $page->name))->attribute('data-slugify', '#uri') !!}

	{!! BootForm::text(url('/') .'/' , 'uri', old('uri',$page->uri)) !!}

	<div class="form-group @if($errors->has('middleware') ) has-error @endif">
		<label class="col-xs-2 control-label" for="middleware">Middleware</label>
		<div class="col-xs-9">

			<select name="middleware[]" id="middleware" multiple>
				@foreach($middleware as $m )
				<option value="{{$m['value']}}" @if(in_array($m['value'], $page->middleware ? : [] ) ) selected @endif>{{$m['name']}}</option>
				@endforeach
			</select>
			<span class="help-block">{{{$errors->first('middleware')}}}</span>
		</div>
	</div>
	
	{!! BootForm::text('Named Route', 'route')->value(old('route', $page->route)) !!}
	
	<div class="form-group @if($errors->has('type') ) has-error @endif">

		<label class="col-xs-2 control-label" for="type">Page Type</label>

		<div class="col-xs-9">
			<select class="form-control select" name="type" id="type" v-el:typeselect>
				<option @if(old('type', $page->type) === 'database') selected @endif value="database">Database</option>	
				<option @if(old('type', $page->type) === 'file') selected @endif value="file">File</option>	
			</select>
			<span class="help-block">{{{$errors->first('type')}}}</span>	
		</div>
	</div>
	
	<div class="form-group @if($errors->has('content') ) has-error @endif" v-show="database">
		<label class="col-xs-2 control-label" for="type">Page Content</label>
		<div class="col-xs-9">
			<textarea name="content" id="content" cols="30" rows="10">{{old('content', $page->content)}}</textarea>
		</div>
	</div>
	

	<div class="form-group @if($errors->has('file') ) has-error @endif" v-show="!database">

		<label class="col-xs-2 control-label" for="type">Page File</label>

		<div class="col-xs-9">
			<select class="form-control select" name="file" id="file" v-el:file>
				<option value="">---</option>
				@foreach($pages as $p)
				<option value="{{{ str_replace('.blade.php','', $p->getRelativePathName())}}}" @if( old('file', $page->file) === str_replace('.blade.php','', $p->getRelativePathName())  ) selected @endif >{{{ str_replace('.blade.php','', $p->getRelativePathName())}}}</option>
				@endforeach
			</select>
			<span class="help-block">{{{$errors->first('file')}}}</span>	
		</div>

	</div>
	
	<div v-show="database">
		{!! BootForm::text('Layout Section', 'section')->value(old('section', $page->section ? : 'content'))->attribute('id', 'section') !!}
	</div>

	<div class="form-group  @if($errors->has('layout') ) has-error @endif">

		<label class="col-xs-2 control-label" for="type">Page Layout</label>

		<div class="col-xs-9">
			<select class="form-control select" name="layout" id="layout" v-el:layout>
				<option value="">---</option>
				@foreach($layouts as $layout)
				<option value="{{{ config('pages.layout_path.name'). str_replace('.blade.php','',$layout->getRelativePathName()) }}}" 
					@if( old('layout', $page->layout) === config('pages.layout_path.name'). str_replace('.blade.php','',$layout->getRelativePathName())  ) 
					selected 
					@endif
					> {{{ config('pages.layout_path.name'). str_replace('.blade.php','',$layout->getRelativePathName()) }}}</option>
					@endforeach
				</select>
				
			</div>

			<span class="help-block">{{{$errors->first('layout')}}}</span>	

		</div>
		
		<div class="form-group">

			<label class="col-xs-2 control-label">Page Status</label>

			<div class="col-xs-9">
				<select class="form-control" name="active" v-el:active>
					<option value="1" @if(! old('active', $page->active)) selected @endif>Active</option>
					<option value="0" @if(! old('active', $page->active)) selected @endif>Draft</option>
				</select>
			</div>
		</div>

	</fieldset>
	{{-- End col-md-12 --}}
