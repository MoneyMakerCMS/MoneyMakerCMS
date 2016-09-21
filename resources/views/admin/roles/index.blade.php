@extends('admin.layouts.master')

@section('content')
<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title"></h3>

		<div class="box-tools pull-right">

		</div><!--box-tools pull-right-->
	</div><!-- /.box-header -->

	<div class="box-body">
		<div class="table-responsive">
			<table id="users-table" class="table table-condensed table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Name</th>
						<th>Created at</th>
						<th>Updated at</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				@foreach($roles as $role)
					<tr>
						<td>{{$role->id}}</td>
						<td>{{$role->title}}</td>
						<td>
						@if($role->abilities->count())
							<pre>{{implode(",\n", $role->abilities->pluck('title')->toArray())}}</pre>
						@endif
						</td>
						<td>{{$role->created_at}}</td>
						<td>{{$role->updated_at}}</td>
					<td><a href="{{route('admin.roles.edit', $role->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title=""></i></a> </td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div><!--table-responsive-->
	</div><!-- /.box-body -->
</div><!--box-->
@endsection
