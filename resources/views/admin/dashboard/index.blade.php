@extends('admin.layouts.master')

@section('page-header')
<h1>
	App Dasboard
	<small>index</small>
</h1>
@endsection

@section('content')
<@extends('admin.layouts.master')

@section('content')
<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title"></h3>

		<div class="box-tools pull-right">
	
		</div><!--box-tools pull-right-->

		@foreach($user->getAbilities() as $ability)
			
		@endforeach
	</div><!-- /.box-header -->
</div><!--box-->
@endsection
@endsection

@section('scripts')

@endsection