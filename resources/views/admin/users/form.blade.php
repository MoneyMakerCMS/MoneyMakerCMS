@extends('admin.layouts.master')

@section('content')
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
		<input type="hidden" name="user_id" value="{{$user->id}}">
		{!! BootForm::text('Name', 'name', old('name', $user->name)) !!}
		{!! BootForm::text('Email', 'email', old('email', $user->email)) !!}
		{!! BootForm::password('Password', 'password') !!}
		{!! BootForm::password('Confirm Password', 'password_confirmation') !!}
		<div class="row">
			<label class="col-sm-2 col-lg-2 control-label" for="roles">Roles</label>
			<div class="col-sm-10 col-lg-10">
				
				@foreach($roles as $role)
				<div class="checkbox">
					<label>
						<input type="checkbox" autocomplete="off" name="roles[]" value="{{$role->id}}" @if($user->isAn($role->name)) checked @endif> {{$role->title}}
					</label>
				</div>
				@endforeach
			
				<hr>
			</div>
		</div>

		{!! BootForm::submit('Save User') !!}
		{!! BootForm::close() !!}
		
	</div>
</div>
@endsection