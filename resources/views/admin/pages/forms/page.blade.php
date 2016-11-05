

<input type="hidden" name="page_id" value="{{ $page->id ? : '' }}">
<fieldset>
	<div class="form-group @if($errors->has('name') ) has-error @endif">
		<label class="col-xs-2 control-label" for="name">Page Name</label>
		<div class="col-xs-9">
			<input type="text" name="name" class="form-control" value="{{old('name', $page->name)}}" data-slugify="#uri">
			<span class="help-block">{{{$errors->first('name')}}}</span>
		</div>
	</div>
	
	<div class="form-group @if($errors->has('route') ) has-error @endif">
		<label class="col-xs-2 control-label" for="route">Page Route</label>
		<div class="col-xs-9">
			<input id="route" type="text" name="route" class="form-control" value="{{old('route', $page->route)}}">
			<span class="help-block">{{{$errors->first('route')}}}</span>
		</div>
	</div>

	<div class="form-group @if($errors->has('uri') ) has-error @endif">
		<label class="col-xs-2 control-label" for="name">Page url</label>
		<div class="col-xs-9">
			<input id="uri" type="text" name="uri" class="form-control" value="{{old('uri', $page->uri)}}">
			<span class="help-block">{{{$errors->first('uri')}}}</span>
		</div>
	</div>

	<div class="form-group @if($errors->has('middleware') ) has-error @endif">
		<label class="col-xs-2 control-label" for="middleware">Middleware</label>
		<div class="col-xs-9">

			<select name="middleware[]" id="middleware" multiple ref="middleware">
				@foreach($middleware as $m )
				<option value="{{$m['value']}}" @if(in_array($m['value'], $page->middleware ? : [] ) ) selected @endif>{{$m['name']}}</option>
				@endforeach
			</select>
			<span class="help-block">{{{$errors->first('middleware')}}}</span>
		</div>
	</div>
	
	<div class="form-group @if($errors->has('type') ) has-error @endif">

		<label class="col-xs-2 control-label" for="type">Page Type</label>

		<div class="col-xs-9">
			<select class="form-control select" name="type" id="type" ref="typeselect">
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
			<select class="form-control select" name="file" id="file" ref="file">
				<option value="">---</option>
				@foreach($pages as $p)
				<option value="{{{ str_replace('.blade.php','', $p->getRelativePathName())}}}" @if( old('file', $page->file) === str_replace('.blade.php','', $p->getRelativePathName())  ) selected @endif >{{{ str_replace('.blade.php','', $p->getRelativePathName())}}}</option>
				@endforeach
			</select>
			<span class="help-block">{{{$errors->first('file')}}}</span>	
		</div>
	</div>
	
	<div class="form-group  @if($errors->has('layout') ) has-error @endif">
		<label class="col-xs-2 control-label" for="type">Page Layout</label>
		<div class="col-xs-9">
			<select class="form-control select" name="layout" id="layout" ref="layout">
				<option value="">---</option>
				@foreach($layouts as $layout)
				<option value="{{{ config('pages.layout_path.name'). str_replace('.blade.php','',$layout->getRelativePathName()) }}}" 
					@if( old('layout', $page->layout) === config('pages.layout_path.name'). str_replace('.blade.php','',$layout->getRelativePathName())  ) 
					selected 
					@endif
					> {{{ $layout->getRelativePathName() }}}</option>
					@endforeach
				</select>
			</div>
			<span class="help-block">{{{$errors->first('layout')}}}</span>	
		</div>

		<div class="form-group @if($errors->has('section') ) has-error @endif">
			<label class="col-xs-2 control-label" for="section">Content Section</label>
			<div class="col-xs-9">
				<input id="section" type="text" name="section" class="form-control" value="{{old('section', $page->section ? : 'content')}}">
				<span class="help-block">{{{$errors->first('section')}}}</span>
			</div>
		</div>
		
		<div class="form-group">

			<label class="col-xs-2 control-label">Page Status</label>

			<div class="col-xs-9">
				<select class="form-control" name="active" ref="active">
					<option value="1" @if(! old('active', $page->active)) selected @endif>Active</option>
					<option value="0" @if(! old('active', $page->active)) selected @endif>Draft</option>
				</select>
			</div>
		</div>

	</fieldset>
	{{-- End col-md-12 --}}
