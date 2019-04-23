@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/adminis')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Unit Kerja</li>
          </ol>
@stop
@section('content')
          
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Unit Kerja</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="dataUnitKerja" class="table table-bordered">
                    <thead>
                      <tr>                        
                        <th width="5%">No.</th>
                        <th width="30%">Nama Unit Kerja</th>                    
                        <th width="20%">No. Telp</th>                            
                        <th width="20%">Alamat E-mail </th>                        
                        <th width="20%"># </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $urut = 1;
                        foreach ($unitKerja as $data):  
                      ?>
                      <tr>
                        <td align="center">{{$urut++}}</td>
                        <td>{{$data->nama_unit_kerja}}</td>
                        <td>{{$data->no_telp}}</td>
                        <td>{{$data->email_unit_kerja}}</td>                       
                        <td align="center">
                          <div class="btn btn-group">
                            <a href="{{{ URL::to('unitKerja/edit/'.$data->id_unit_kerja.'') }}}" class="btn btn-primary" title="Edit Data">
                              <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{{ URL::to('unitKerja/delete/'.$data->id_unit_kerja.'') }}}" class="btn btn-danger" title="Hapus Data">
                              <i class="fa fa-trash"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <?php endforeach  ?> 
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->

@endsection
@section('script')

    <script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
      $(function () {

        $('#dataUnitKerja').DataTable({"pageLength": 10});

      });

    </script>

@endsection

