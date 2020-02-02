@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Rekap Usulan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Rekap Usulan</li>
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
                    <td width="60%">
                        <div class="box-header">
                            <b><h2 style="padding:0;">Data Usulan</h2></b>
                        </div>
                    </td>
                    <td width="40%" style="text-align:right">
                        <div class="btn-group">
                            <a href="{{URL::to('/rekapUsulan/pdf/'.$tahun)}}" target="blank" class="btn btn-warning btn-xs"><i class="fa fa-print"></i> Cetak PDF</a>
                            <a href="{{URL::to('/laporan/usulan/eksport/'.$tahun)}}" target="blank" class="btn btn-primary btn-xs"><i class="fa fa-file-excel-o"></i> Eksport Usulan</a>
                            {{-- <a href="{{URL::to('/laporan/barangUsulan/eksport/'.$tahun)}}" target="blank" class="btn btn-info btn-xs"><i class="fa fa-file-excel-o"></i> Eksport Item Barang Usulan</a> --}}
                        </div>
                    </td>
                </tr>
            </table>
            
            <hr>

            <table class="table table-bordered" id="rekapUsulan" width="100%">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Jenis Usulan</th>
                        <th width="5%">Jumlah Usulan</th>
                        <th width="15%">RAB Usulan</th>
                        <th width="5%">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usulan as $data)
                        <tr>
                            <td>{{$urut++}}</td>
                            <td>{{getJenis($data->jenis_usulan)}}</td>
                            <td style="text-align:center">{{getNumberTanpaKoma($data->countUsulan)}}</td>
                            <td style="text-align:right">{{getNumber($data->jum_usulan)}}</td>
                            <td style="text-align:center"><a href="{{URL::to('/rDetailUsulan/'.$tahun.'/'.$data->jenis_usulan)}}" class="btn btn-primary btn-sm">Detail</a></td>
                        </tr>

                        <?php $total+=$data->jum_usulan; ?>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align:right"><b>Total</b></td>
                        <td style="text-align:right"><b>{{getNumber($total)}}</b></td>
                        <td></td>
                    </tr>
                </tfoot>
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