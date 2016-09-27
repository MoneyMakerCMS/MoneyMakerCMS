@extends('admin.layouts.master')

@section('page-header')
<h1>
	App Pages
	<small>index</small>
</h1>
@endsection

@section('content')
<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title"></h3>

		<div class="box-tools pull-right">

		</div><!--box-tools pull-right-->
	</div><!-- /.box-header -->

	<div class="box-body">
		<div class="table-responsive">
			<table id="pages-table" class="table table-condensed table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Uri</th>
						<th>Type</th>
						<th>Active</th>
						<th>Created at</th>
						<th>Updated at</th>
						<th>Actions</th>
					</tr>
				</thead>
			</table>
		</div><!--table-responsive-->
	</div><!-- /.box-body -->
</div><!--box-->
@endsection

@section('scripts')
<script>
	$(function() {
		$('#pages-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url: '{{ route("admin.pages.get") }}',
				type: 'get'
			},
			columns: [
				{ data: 'id', name: 'id' },
				{ data: 'name', name: 'name' },
				{ data: 'uri', name: 'uri'},
				{ data: 'type', name: 'type' },
				{ data: 'active', name: 'active' },
				{ data: 'created_at', name: 'created_at' },
				{ data: 'updated_at', name: 'updated_at' },
				{ data: 'actions', name: 'actions' , searchable: false }
			],
			order: [
				[0, "asc"]
			],
			searchDelay: 500
		});
	});
</script>
@stop