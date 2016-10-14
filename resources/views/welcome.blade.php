@extends('admin.layouts.master')


@section('content')
<div class="card">
    <div class="card-header">
        <strong>Users</strong><small> index</small>
    </div>
    <div class="card-block">
        {!! $dataTable->table() !!}
    </div>
</div>
@endsection

@section('scripts')
<script src="/javascript/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/javascript/vendor/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/javascript/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endsection