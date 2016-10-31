@extends('admin.layouts.master')



@section('after-styles')
<link rel="stylesheet" href="{{url('stylesheets/admin/pages.css')}}">
<link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@stop

@section('content')
<form id="page-form" class="form-horizontal" method="POST">
  {{csrf_field()}}
  <div class="nav-tabs-custom" style="padding-bottom:20px;">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#page" aria-controls="page" role="tab" data-toggle="tab">Page</a></li>
      <li role="presentation"><a href="#seo" aria-controls="seo" role="tab" data-toggle="tab">Page Meta</a></li>
      {{-- <li role="presentation"><a href="#media" aria-controls="media" role="tab" data-toggle="tab">Media</a></li>
      <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li> --}}
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade in active" id="page">@include('admin.pages.forms.page')</div>
      <div role="tabpanel" class="tab-pane fade" id="seo">@include('admin.pages.forms.meta')</div>
      {{-- <div role="tabpanel" class="tab-pane fade" id="media"></div>
      <div role="tabpanel" class="tab-pane fade" id="settings"></div> --}}
    </div>
    <div class="form-group">
      <label class="col-xs-2 control-label" for=""></label>
      <div class="col-xs-9">
        <button class="btn btn-default">Save Page</button>
      </div>
    </div>
  </div>

</form>
@stop


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

{{--
<div class="tab-pane active" id="page">
  @include('admin.pages.forms.page')

</div>
<div class="tab-content">
  <div class="tab-pane" id="seo">
     
  </div>

  --}}
