@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Laporan Detail Per Jenis Belanja</small>
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
                <a href="{{{URL::to('telaah/rekapUsulan/'.$tahun)}}}" class="btn btn-primary " role="button">{{$tahun}}</a>
                <a href="#" class="btn btn-info">{{getJenis($jenis)}}</a>
            </div>
        </div>
    </div>

    <?php 
        $urut   = 1;
        $total = 0;
        $totalTelaah = 0;
        $totalSelisih = 0;
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
                            <b><h2 style="padding:0;">Rekap Usulan dan Telaah Belanja {{getJenis($jenis)}}</h2></b>
                        </div>
                    </td>
                    <td width="30%" style="text-align:right">
                        <div class="btn-group">
                            <a href="{{URL::to('/rekapUsulan/pdf/'.$tahun)}}" target="blank" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Cetak PDF</a>
                            <a href="{{URL::to('/rekapUsulan/excel/'.$tahun)}}" class="btn btn-warning btn-sm"><i class="fa fa-file-excel-o"></i> Eksport Excel</a>
                        </div>
                    </td>
                </tr>
            </table>
            
            <hr>

            <table class="table table-bordered" id="rekapUsulan" width="100%">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="5%">No Telaah</th>
                        <th width="5%">Tgl. Telaah</th>
                        <th width="25%">Perihal</th>
                        <th width="15%">RAB Usulan</th>
                        <th width="15%">RAB Telaah</th>
                        <th width="15%">Sisa/Kurang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usulan as $data)
                        <?php $selisih = $data->jum_usulan-$data->jum_telaah; ?>
                        <tr>
                            <td>{{$urut++}}</td>
                            <td>{{$data->no_telaah}}</td>
                            <td>{{$data->tgl_telaah}}</td>
                            <td>{{$data->perihal_usulan}}</td>
                            <td style="text-align:right">{{getNumber($data->jum_usulan)}}</td>
                            <td style="text-align:right">{{getNumber($data->jum_telaah)}}</td>
                            <td style="text-align:right">{{getNumber($selisih)}}</td>
                        </tr>

                        <?php $total+=$data->jum_usulan; ?>
                        <?php $totalTelaah+=$data->jum_telaah; ?>
                        <?php $totalSelisih+=$selisih; ?>
                    @endforeach
                </tbody>
                <tfoot>
                    <td colspan="4">Total</td>
                    <td style="text-align:right">{{getNumber($total)}}</td>
                    <td style="text-align:right">{{getNumber($totalTelaah)}}</td>
                    <td style="text-align:right">{{getNumber($totalSelisih)}}</td>
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