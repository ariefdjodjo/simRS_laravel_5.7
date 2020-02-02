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
  <div class="callout callout-info">
    <h4>Selamat Datang Unit Kerja Pengusul!</h4>
    <p> </p>
  </div>
  
  <div class="box box-primary"style="padding:10px">
    
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="align:center">
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
        <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="{{URL::asset('img/gedung_sardjito.jpg')}}" alt="First slide">

          <div class="carousel-caption">
           <h3>Gedung Rawat Jalan RSUP Dr. Sardjito</h3> 
          </div>
        </div>
        <div class="item">
          <img src="{{URL::asset('img/mbah_jito.jpg')}}" alt="Second slide">

          <div class="carousel-caption">
            <h3>Instalasi Rawat Jalan RSUP Dr. Sardjito</h3> 
          </div>
        </div>
        <div class="item">
          <img src="{{URL::asset('img/perawat_amarta.jpg')}}" alt="Third slide">

          <div class="carousel-caption">
            <h3>Layanan VIP Paviliun Amarta</h3>
          </div>
        </div>
        <div class="item">
            <img src="{{URL::asset('img/call_center.jpg')}}" alt="Third slide">

            <div class="carousel-caption">
              <h3>Call Center RSUP Dr. Sardjito</h3>
            </div>
        </div>
      </div>
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="fa fa-angle-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="fa fa-angle-right"></span>
      </a>
    </div>

    <section class="content">
      <div class="row">
        <div class="box box-success box-solid">
          <div class="box-header">
            <i class="fa fa-bar-chart"></i><b> GRAFIK USULAN</b>
          </div>
          <div class="box-body" style="margin:10px">
            <table class="highchart1 table table-bordered hidden" data-graph-container-before="1" data-graph-type="column" width="50%" style="">
              
              <thead>
                <tr>
                  <th>Tahun</th>
                  <th>Cetakan</th>
                  <th>ATK</th>
                  <th>BRT</th>
                  <th>Obat-obatan</th>
                  <th>AMBP/BMHP</th>
                  <th>Operasional</th>
                  <th>Jasa</th>
                  <th>Bahan Makanan</th>
                  <th>Investasi Alat Kesehatan</th>
                  <th>Investasi Non Medis</th>
                  <th>Perangkat Pengolah Data</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($grafik as $item)
                  <tr>
                    <td>{{$item->tahun}}</td>
                    <td>{{$item->cetakan}}</td>
                    <td>{{$item->atk}}</td>
                    <td>{{$item->brt}}</td>
                    <td>{{$item->obat}}</td>
                    <td>{{$item->amhp}}</td>
                    <td>{{$item->operasional}}</td>
                    <td>{{$item->jasa}}</td>
                    <td>{{$item->bm}}</td>
                    <td>{{$item->alkes}}</td>
                    <td>{{$item->nonMed}}</td>
                    <td>{{$item->ppd}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
@section('script')

    <script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" >
      $(document).ready(function() {
          $('table.highchart1')
            .bind('highchartTable.beforeRender', function(event, highChartConfig){
              highChartConfig.tooltip = {
                headerFormat: "",
                pointFormat: "{series.name} : {point.y:,.0f} dok"
              };
              // highChartConfig.plotOptions = {
              //   bar: {
              //     dataLabels: {
                    
              //     }
              //   }
              // }
          })
          .highchartTable();
          // $('table.highchart1')
          // .bind('highchartTable.beforeRender', function(event, highChartConfig) {
          //   $.each(highChartConfig.tooltip, function (index, value)   {
              
          //       pointFormat: "{point.y:,.0f} dok"
              
          //   });
          // }).highchartTable();
      });
    </script>

@endsection