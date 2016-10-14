@extends('admin.layouts.master')

@section('page-header')
<h1>
	App Content
	<small>manage</small>
</h1>
@endsection

@section('after-styles')
<link rel="stylesheet" href="{{url('stylesheets/admin/content.css')}}">
<link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@stop

@section('content')
<div class="box">
	<div class="box-body">
		



		<div class="box-body">
			{!! BootForm::openHorizontal(['sm' => [2, 10], 'lg' => [2, 10] ])->id('content-form') !!}
			<input type="hidden" name="content_id" value="{{ $content->id ? : '' }}">
			{!! BootForm::text('Name', 'name', old('name',$content->name))->attribute('data-slugify', '#slug') !!}
			{!! BootForm::text('Slug', 'slug', old('slug',$content->slug))!!}

			<div class="form-group @if($errors->has('type') ) has-error @endif">
				<label class="col-xs-2 control-label">Type</label>
				<div class="col-xs-9">
					<select class="form-control select" name="type" id="type" v-el:typeselect>
						<option @if(old('type', $content->type) === 'database') selected @endif value="database">Database</option>	
						<option @if(old('type', $content->type) === 'file') selected @endif value="file">File</option>	
					</select>
				</div>

				<span class="help-block">{{{$errors->first('type')}}}</span>
			</div>

			<div class="form-group @if($errors->has('value') ) has-error @endif"  v-show="database">
			<label class="col-xs-2 control-label">Content</label>
				<div class="col-xs-9">
					<textarea class="form-control" name="value" id="value" placeholder="{{{ trans('ninjaparade/content::model.general.value') }}}">{{{ old('value', $content->value) }}}</textarea>	        	
				</div>

				<span class="help-block">{{{$errors->first('value')}}}</span>
			</div>

			<div class="form-group @if($errors->has('file') ) has-error @endif" v-show="!database">
				<label class="col-xs-2 control-label"></label>
				<div class="col-xs-9">
					<select class="form-control select" name="file" id="file" v-el:file>
						<option value="">---</option>
						@foreach($files as $p)
						<option value="{{{ $p->getRelativePathName() }}}" @if( old('file', $content->file) === $p->getRelativePathName() )  ) selected @endif> {{{ $p->getRelativePathName() }}}</option>
						@endforeach
					</select>
				</div>

				<span class="help-block">{{{$errors->first('file')}}}</span>
			</div> 

			<div class="form-group @if($errors->has('html') ) has-error @endif">

				<label class="col-xs-2 control-label">Output</label>

				<div class="col-xs-9">
					<select class="form-control select" name="html" id="html" v-el:html>
						<option @if(old('html', $content->html)) selected @endif value="1">HTML/Markup</option>	
						<option @if(old('html', ! $content->html)) selected @endif value="0">Plain Text</option>
					</select>
				</div>

				<span class="help-block">{{{$errors->first('html')}}}</span>
			</div>

			<div class="form-group @if($errors->has('enabled') ) has-error @endif">

				<label class="col-xs-2 control-label" for="enabled">State</label>

				<div class="col-xs-9">
					<select class="form-control select" name="enabled" id="enabled" v-el:enabled>
						<option @if(old('enabled', 	$content->enabled)) selected @endif value="1">Published</option>	
						<option @if(old('enabled', !$content->enabled)) selected @endif value="0">Draft</option>
					</select>
				</div>

				<span class="help-block">{{{$errors->first('html')}}}</span>
			</div>


			{!! BootForm::submit('Save Content') !!}
			{!! BootForm::close() !!}
		</div><!-- /.box-body -->

	</div>
</div>
@stop


@section('after-scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
<script>
	var Content = {
		database: @if( old('type', $content->type) === 'database' || old('type', $content->type) === null ) true @else false @endif
	};
</script>
<script src="{{url('javascript/admin/content.js')}}"></script>
@stop