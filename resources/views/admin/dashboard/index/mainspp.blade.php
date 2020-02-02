@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>SPP Anggaran</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard SPP</li>
  </ol>
@stop
@section('content')

  {{-- Selamat datang --}}
  <div class="callout callout-info">
    <h4>Selamat Datang Unit Kerja Pembuat Surat Persetujuan Pengadaan!</h4>
    <p> </p>
  </div>

  <div class="box box-primary">
    <section class="content">
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$usulan}} <sup style="font-size:20px">Dokumen</sup></h3>
                <p>Surat Usulan</p>
            </div>
            <div class="icon">
              <i class="fa fa-envelope"></i>
            </div>
            <a href="#" class="small-box-footer">Lihat rincian <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$telaah}} <sup style="font-size:20px">Dokumen</sup></h3>
                <p>Surat Telaah</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text-o"></i>
            </div>
            <a href="#" class="small-box-footer">Lihat rincian <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$sp}} <sup style="font-size:20px">Dokumen</sup></h3>
                <p>SPP</p>
            </div>
            <div class="icon">
              <i class="fa fa-tags"></i>
            </div>
            <a href="#" class="small-box-footer">Lihat rincian <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      {{-- CAROUSEL GAMBAR --}}
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

        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"><span class="fa fa-angle-left"></span></a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"><span class="fa fa-angle-right"></span></a>
      </div>
    {{-- END CAROUSEL --}}

	<script type="text/javascript" >
		$(document).ready(function() {
  			$('table.highchart1').highchartTable();
      });
  </script>

    <section class="content">
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <div class="box box-warning box-solid">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>
              <h3 class="box-title">GRAFIK SURAT USULAN</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
              <table class="highchart1 table table-bordered " data-graph-container-before="1" data-graph-type="pie" width="50%" style="">
                <thead>
                  <tr>
                    <th>Tahun</th>
                    <th>Dokumen Usulan</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($usulanPie as $a)
                    <tr>
                      <td>{{$a->tahun}}</td>
                      <td>{{$a->jumUsulanPie}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6">
          <div class="box box-info box-solid">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>
              <h3 class="box-title">GRAFIK SURAT TELAAH</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
              <table class="highchart1 table table-bordered" data-graph-container-before="1" data-graph-type="pie" width="50%" style="">
                <thead>
                  <tr>
                    <th>Tahun</th>
                    <th>Dokumen Telaah</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($telaahPie as $b)
                    <tr>
                      <td>{{$b->tahun}}</td>
                      <td>{{$b->jumTelaahPie}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">GRAFIK SPP</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
              <table class="highchart1 table table-bordered" data-graph-container-before="1" data-graph-type="pie" width="50%" style="">
                <thead>
                  <tr>
                    <th>Tahun</th>
                    <th>Dokumen SPP</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($spPie as $c)
                    <tr>
                      <td>{{$c->tahun}}</td>
                      <td>{{$c->jumSpPie}}</td>
                    </tr>
                  @endforeach
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>      
</div>

@endsection
