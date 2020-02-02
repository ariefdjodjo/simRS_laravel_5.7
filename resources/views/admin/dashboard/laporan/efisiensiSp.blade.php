@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Laporan Penerbitan SPP</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Laporan SPP</li>
  </ol>
@stop

@section('content')
    <?php 
        $urut   = 1;
        $jum_barang = 0;
    ?>
    @if($tahun == 0)
    <div class="box box-primary">
        <div class="box-header">
            <b><h3>Rekap Efisiensi Anggaran Berdasar Penerbitan SP Anggaran</h3></b>
        </div>
        <div class="box-body">
            <table class="highchart1 table table-bordered hidden" data-graph-container-before="1" data-graph-type="column" width="50%" style="">
                <thead>
                    <tr>
                        <th width="5%" style="text-align:center">TAHUN</th>
                        <th width="15%" style="text-align:center">PAGU ALOKASI</th>
                        <th width="15%" style="text-align:center">RAB USULAN</th>
                        <th width="15%" style="text-align:center">RAB TELAAH</th>
                        <th width="15%" style="text-align:center">PENYERAPAN SP</th>
                        <th width="15%" style="text-align:center">SISA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekap as $th)
                        <tr>
                            <td>{{$th->tahun}}</td>
                            <td style="text-align:right">{{$th->pagu}}</td>
                            <td style="text-align:right">{{$rabUsulan[$th->tahun]->rab_usulan}}</td>
                            <td style="text-align:right">{{$rabTelaah[$th->tahun]->rab_telaah}}</td>
                            <td style="text-align:right">{{$rabSp[$th->tahun]->rab_sp}}</td>
                            <td style="text-align:right">{{$sisa[$th->tahun]}}</td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>

            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th width="5%" style="text-align:center">TAHUN</th>
                        <th width="15%" style="text-align:center">PAGU ALOKASI</th>
                        <th width="15%" style="text-align:center">RAB USULAN</th>
                        <th width="15%" style="text-align:center">RAB TELAAH</th>
                        <th width="15%" style="text-align:center">PENYERAPAN SP</th>
                        <th width="15%" style="text-align:center">SISA</th>
                        <th width="15%" style="text-align:center">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekap as $th)
                        <tr>
                            <td>{{$th->tahun}}</td>
                            <td style="text-align:right">{{getNumber($th->pagu)}}</td>
                            <td style="text-align:right">{{getNumber($rabUsulan[$th->tahun]->rab_usulan)}}</td>
                            <td style="text-align:right">{{getNumber($rabTelaah[$th->tahun]->rab_telaah)}}</td>
                            <td style="text-align:right">{{getNumber($rabSp[$th->tahun]->rab_sp)}}</td>
                            <td style="text-align:right">{{getNumber($sisa[$th->tahun])}}</td>
                            <td style="text-align:center"><a href="" class="btn btn-sm btn-primary"> Detail</a></td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    @else
        <div class="box box-primary">
            <div class="box-header">
                <b>
                    <h3>Rekap Penerbitan SP Anggaran</h3>
                    <h3>Tahun {{$tahun}}</h3>
                </b>
            </div>
            <div class="box-body">
                
            </div>
        </div>
    @endif
@stop

@section('script')   
<script type="text/javascript" >
    $(document).ready(function() {
          $('table.highchart1').highchartTable();
  });
</script>

@endsection



    
