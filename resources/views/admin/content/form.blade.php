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
		<form id="content-form" class="form-horizontal" method="POST">
			{{csrf_field()}}
			
			<input type="hidden" name="content_id" value="{{ $content->id ? : '' }}">
			
			<div class="form-group @if($errors->has('name') ) has-error @endif">
				<label class="col-xs-2 control-label" for="name">Content Name</label>
				<div class="col-xs-9">
					<input id="name" type="text" name="name" class="form-control" value="{{old('name', $content->name)}}" data-slugify="#slug">
					<span class="help-block">{{{$errors->first('name')}}}</span>
				</div>
			</div>

			<div class="form-group @if($errors->has('slug') ) has-error @endif">
				<label class="col-xs-2 control-label" for="slug">Content Slug</label>
				<div class="col-xs-9">
					<input id="slug" type="text" name="slug" class="form-control" value="{{old('slug', $content->slug)}}">
					<span class="help-block">{{{$errors->first('slug')}}}</span>
				</div>
			</div>

			<div class="form-group @if($errors->has('type') ) has-error @endif">
				<label class="col-xs-2 control-label">Type</label>
				<div class="col-xs-9">
					<select class="form-control select" name="type" id="type" ref="typeselect">
						<option @if(old('type', $content->type) === 'database') selected @endif value="database">Database</option>	
						<option @if(old('type', $content->type) === 'file') selected @endif value="file">File</option>	
					</select>
				</div>

				<span class="help-block">{{{$errors->first('type')}}}</span>
			</div>
			
			<div class="form-group @if($errors->has('file') ) has-error @endif" v-if="!database">
				<label class="col-xs-2 control-label">File</label>
				<div class="col-xs-9">
					<select class="form-control select" name="file" id="file" ref="filepicker">
						<option value="">---</option>
						@foreach($files as $p)
						<option value="{{{ $p->getRelativePathName() }}}" @if( old('file', $content->file) === $p->getRelativePathName() ) selected @endif> {{{ $p->getRelativePathName() }}}</option>
						@endforeach
					</select>
				</div>

				<span class="help-block">{{{$errors->first('file')}}}</span>
			</div> 

			<div class="form-group @if($errors->has('value') ) has-error @endif"  v-if="database">
				<label class="col-xs-2 control-label">Content</label>
				<div class="col-xs-9">
					<textarea class="form-control" name="value" id="value" placeholder="{{{ trans('ninjaparade/content::model.general.value') }}}">{{{ old('value', $content->value) }}}</textarea>	        	
				</div>

				<span class="help-block">{{{$errors->first('value')}}}</span>
			</div>

			<div class="form-group @if($errors->has('html') ) has-error @endif">

				<label class="col-xs-2 control-label">Output</label>

				<div class="col-xs-9">
					<select class="form-control select" name="html" id="html" ref="html">
						<option @if(old('html', $content->html)) selected @endif value="1">HTML/Markup</option>	
						<option @if(old('html', ! $content->html)) selected @endif value="0">Plain Text</option>
					</select>
				</div>

				<span class="help-block">{{{$errors->first('html')}}}</span>
			</div>

			<div class="form-group @if($errors->has('enabled') ) has-error @endif">

				<label class="col-xs-2 control-label" for="enabled">State</label>

				<div class="col-xs-9">
					<select class="form-control select" name="enabled" id="enabled" ref="enabled">
						<option @if(old('enabled', 	$content->enabled)) selected @endif value="1">Published</option>	
						<option @if(old('enabled', !$content->enabled)) selected @endif value="0">Draft</option>
					</select>
				</div>

				<span class="help-block">{{{$errors->first('html')}}}</span>
			</div>

			<div class="form-group">
				<label class="col-xs-2 control-label" for="submit"></label>
				<div class="col-xs-9">
					<button class="btn btn-default">Save Content</button>
				</div>
			</div>
		</form>
	</div><!-- /.box-body -->
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