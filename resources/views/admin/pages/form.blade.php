@extends('admin.layouts.master')



@section('after-styles')
<link rel="stylesheet" href="{{url('stylesheets/admin/pages.css')}}">
<link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@stop


{{-- Page --}}
@section('content')
<div class="box box-success">
    <div class="box-body">
        <div class="box-body" id="pageForm">
            <h3 class="box-title"></h3>
            <div class="row nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#page">Page</a></li>
                    <li><a href="#seo">SEO</a></li>
                    <li><a href="#media">Media</a></li>
                </ul>
                {!! BootForm::openHorizontal(['sm' => [2, 9],'md' => [2, 9]]) !!}

                <div class="tab-content">
                    <div class="tab-pane active" id="page">@include('admin.pages.forms.page')
                       <div class="form-group">

                        <label class="col-xs-2 control-label" for="submit">{{{ trans('action.save') }}}</label>

                        <div class="col-xs-9">
                            <button type="submit" class="btn btn-success" id="save"><i class="fa fa-save"></i> {{{ "Save" }}}</button>
                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="seo">@include('admin.pages.forms.meta')
                 <div class="form-group">

                    <label class="col-xs-2 control-label" for="submit">{{{ trans('action.save') }}}</label>

                    <div class="col-xs-9">
                        <button type="submit" class="btn btn-success" id="save"><i class="fa fa-save"></i> {{{ "Save" }}}</button>
                    </div>

                </div>
            </div>
            {!! BootForm::close() !!}

            <div class="tab-pane" id="media">{{-- @include('ninjaparade/media::admin.dashboard.ajax-upload') --}}</div>
        </div>
    </div>
</div>
</div>
</div>


@stop


@section('after-scripts')

@section('after-scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
<script>
    var Page = {
        database: @if( old('type', $page->type) === 'database' || old('type', $page->type) === null ) true
            @else false @endif,
    };
</script>
<script src="{{url('javascript/admin/pages.js')}}"></script>
@stop
