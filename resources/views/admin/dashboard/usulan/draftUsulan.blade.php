@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Draft Usulan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Draft Usulan</li>
  </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <div class="btn-group">
                @foreach($th as $data)
                    <a href="{{{URL::to('usulan/draftUsulan/'.$data->tahun)}}}" 
                        @if($tahun == $data->tahun)
                            class="btn btn-primary " 
                        @else 
                            class="btn btn-default " 
                        @endif
                        role="button">{{$data->tahun}}</a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <b><h3>Data Draft Usulan</h3></b>
        </div>
        <div class="box-body">
            @if($tahun==0)
            <h3>PILIH TAHUN</h3>
            @else
            
            <table class="table table-bordered" id="draftUsulan">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Nomor Usulan</th>
                        <th width="25%">Perihal Usulan</th>
                        <th width="15%">RAB</th>
                        <th width="10%">Lampiran</th>
                        <th width="10%">#</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            
            @endif
        </div>
    </div>
@stop

@section('script')    
    <script>
      $(function () {
        $('#draftUsulan').DataTable({"pageLength": 10});
      });
    </script>
@endsection