@extends('admin.layouts.master')

@section('page-header')
<h1>
	Users Roles
	<small>manage</small>
</h1>
@endsection

@section('content')
{{ Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">Create User</h3>

		<div class="box-tools pull-right">

		</div><!--box-tools pull-right-->
	</div><!-- /.box-header -->

	<div class="box-body">
		
		{!! BootForm::openHorizontal(['sm' => [2, 10], 'lg' => [2, 10] ]) !!}
		<input type="hidden" name="role_id" value="{{$role->id}}">
		{!! BootForm::text('Title', 'title', old('title', $role->title)) !!}
		
		<div class="row">
			<label class="col-sm-2 col-lg-2 control-label" for="roles">Abilities</label>
			<div class="col-sm-10 col-lg-10">
				
				@foreach($abilities as $ability)
				<div class="checkbox">
					<label>
						<input type="checkbox" autocomplete="off" name="abilities[]" value="{{$ability->id}}" 
						@if( $role->can($ability->name, $ability->entity_type) ) checked @endif> {{$ability->title}}
					</label>
				</div>
				@endforeach
			
				<hr>
			</div>
		</div>

		{!! BootForm::submit('Save Role') !!}
		{!! BootForm::close() !!}
		
	</div>
</div>
@endsection