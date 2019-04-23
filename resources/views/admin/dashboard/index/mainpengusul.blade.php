@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Unit Kerja</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard Unit Kerja</li>
          </ol>
@stop
@section('content')
          
          coba

@endsection
@section('script')

    <script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>


@endsection