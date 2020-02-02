@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Rekap Usulan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{URL::to('/rekapUsulan/'.$tahun)}}"><i class="fa fa-dashboard"></i> Rekap Usulan</a></li>
    <li class="active">Rekap Detail Usulan</li>
  </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <div class="btn-group">
                @foreach($th as $data)
                    <a href="{{{URL::to('rekapUsulan/'.$data->tahun)}}}" 
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

    <?php 
        $urut   = 1;
        $total = 0;
    ?>
    <div class="box box-primary">
        
        <div class="box-body">
            @if($tahun==0)
            <h3>PILIH TAHUN</h3>
            @else
            <table width="100%">
                <tr>
                    <td width="70%">
                        <div class="box-header">
                            <b><h2 style="padding:0;">Rekap Detail Usulan</h2></b>
                            <b><h3>{{getJenis($jenis)}}</h3></b>
                        </div>
                    </td>
                    <td width="30%" style="text-align:right">
                        <div class="btn-group">
                            <a href="{{URL::to('/rDetailUsulan/pdf/'.$tahun.'/'.$jenis)}}" target="blank" class="btn btn-info btn-xs"><i class="fa fa-print"></i> Cetak PDF</a>
                            <a href="{{URL::to('/rekapUsulan/excel/'.$tahun.'/'.$jenis)}}" class="btn btn-warning btn-xs"><i class="fa fa-file-excel-o"></i> Eksport Excel</a>
                        </div>
                    </td>
                </tr>
            </table>
            
            <hr>

            <table class="table table-bordered" id="draftUsulan">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Nomor Usulan</th>
                            <th width="10%">Lampiran</th>
                            <th width="25%">Perihal Usulan</th>
                            <th width="15%">RAB</th>
                            <th width="10%">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usulan as $data)
                            <tr>
                                <td>{{$urut++}}</td>
                                <td>{{$data->no_usulan}}</td>
                                <td>{{getTfi($data->tgl_usulan)}}</td>
                                <td>{{$data->perihal_usulan}}</td>
                                <td style="text-align:right">{{getNumber($data->jum)}}</td>
                                <td>
                                    <a href="{{url('usulan/detail/'.$data->id_usulan.'')}}" class="btn btn-primary btn-sm"><i class="fa fa-loop"></i> Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            
            @endif
        </div>
    </div>
@stop

@section('script')    
    <script>
      $(function () {
        $('#rekapUsulan').DataTable({"pageLength": 10});
      });
    </script>
@endsection