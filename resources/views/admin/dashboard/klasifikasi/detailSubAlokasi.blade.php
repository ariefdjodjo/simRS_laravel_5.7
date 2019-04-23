@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>SPP Anggaran</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Klasifikasi Anggaran</li>
          </ol>
@stop
@section('content')

<div class="box box-primary">
    <div class="box-header">
      <div class="btn-group">
            <a href="{{url('klasifikasi/')}}" class="btn btn-warning " role="button">TA : {{$subAlokasi->tahun}}</a>
            <a href="{{url('klasifikasi/'.$subAlokasi->tahun.'')}}" class="btn btn-warning" role="button">{{getKode($subAlokasi->kode_kegiatan)}}</a>
            <a href="{{url('klasifikasi/'.$subAlokasi->tahun.'/'.$subAlokasi->id_kegiatan.'')}}" class="btn btn-warning" role="button">{{getKode($subAlokasi->kode_output)}}</a>
            <a href="{{url('klasifikasi/'.$subAlokasi->tahun.'/'.$subAlokasi->id_kegiatan.'/'.$subAlokasi->id_output.'')}}" class="btn btn-warning" role="button">{{getKode($subAlokasi->kode_sub_output)}}</a>
            <a href="{{url('klasifikasi/'.$subAlokasi->tahun.'/'.$subAlokasi->id_kegiatan.'/'.$subAlokasi->id_output.'/'.$subAlokasi->id_sub_output.'')}}" class="btn btn-warning" role="button">{{getKode($subAlokasi->kode_komponen)}}</a>
            <a href="{{url('klasifikasi/'.$subAlokasi->tahun.'/'.$subAlokasi->id_kegiatan.'/'.$subAlokasi->id_output.'/'.$subAlokasi->id_sub_output.'/'.$subAlokasi->id_sub_komponen)}}" class="btn btn-warning" role="button">{{getKode($subAlokasi->kode_sub_komponen)}}</a>
            <a href="{{url('klasifikasi/'.$subAlokasi->tahun.'/'.$subAlokasi->id_kegiatan.'/'.$subAlokasi->id_output.'/'.$subAlokasi->id_sub_output.'/'.$subAlokasi->id_komponen.'/'.$subAlokasi->id_sub_komponen)}}" class="btn btn-warning" role="button">{{$subAlokasi->uraian_sub_alokasi}}</a>
            <a href="" class="btn btn-default">Detail</a>
      </div>
    </div>
  </div>

@if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

  <table class="table" width="100%">
    <tr>
      <td width="70%">
        <div class="box ">
            <div class="box-header with-border">
              <h3 class="box-title">DATA SUB ALOKASI</h3>
            </div>
            <div class="box-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('klasifikasi/addSubAlokasi') }}">
                        @csrf
                        <div class="form-group">
                            <label for="satker" class="col-md-4 control-label text-md-right">{{ __('Tahun') }}</label>
                            <div class="col-md-6">
                                {{$subAlokasi->tahun}}
                                <small class="help-block"></small>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="satker" class="col-md-4 control-label text-md-right">{{ __('Kode Kementerian/Lembaga') }}</label>
            
                            <div class="col-md-6">
                                024 - Kementerian Kesehatan
                                <input type="hidden" class="" name="kl" id="kl" value="024.04">
                                <small class="help-block"></small>
                            </div>
                        </div>
            
            
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label text-md-right">{{ __('Kode Satker') }}</label>
            
                            <div class="col-md-6">
                                415582 - RSUP Dr. Sardjito Yogyakarta
                                <input Type="hidden" id="satker" name="satker" value="415582" required autofocus>
                                <small class="help-block"></small>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label for="kode_kegiatan" class="col-md-4 control-label">{{ __('Kode Kegiatan') }}</label>
            
                            <div class="col-md-6">
                                {{getKode($subAlokasi->kode_kegiatan)}} - {{$subAlokasi->uraian_kegiatan}}
                                <small class="help-block"></small>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label for="kode_output" class="col-md-4 control-label">{{ __('Kode Output') }}</label>
            
                            <div class="col-md-6">
                                {{getKode($subAlokasi->kode_output)}} - {{$subAlokasi->uraian_output}}
                            
                                <small class="help-block"></small>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label for="kode_sub_output" class="col-md-4 control-label">{{ __('Kode Output') }}</label>
            
                            <div class="col-md-6">
                                {{getKode($subAlokasi->kode_sub_output)}} - {{$subAlokasi->uraian_sub_output}}
                                <small class="help-block"></small>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label for="kode_komponen" class="col-md-4 control-label">{{ __('Kode Komponen') }}</label>
            
                            <div class="col-md-6">
                                {{getKode($subAlokasi->kode_komponen)}} - {{$subAlokasi->uraian_komponen}}
                            
                                <small class="help-block"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kode_sub_komponen" class="col-md-4 control-label">{{ __('Kode Sub Komponen') }}</label>
            
                            <div class="col-md-6">
                                {{getKode($subAlokasi->kode_sub_komponen)}} - {{$subAlokasi->uraian_sub_komponen}}
                            
                                <small class="help-block"></small>
                            </div>
                        </div>
            
                        <div class="form-group row">
                            <label for="username" class="col-md-4 control-label text-md-right">{{ __('Kode Akun') }}</label>
                            <div class="col-md-6">
                                {{$subAlokasi->kode_akun}} - {{$subAlokasi->uraian_akun}}
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="username" class="col-md-4 control-label text-md-right">{{ __('PPK') }}</label>
                            <div class="col-md-6">
                                {{$subAlokasi->nama_ppk}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 control-label text-md-right">{{ __('Uraian Sub Alokasi') }}</label>
                            <div class="col-md-6">
                                {{$subAlokasi->uraian_sub_alokasi}}
                            </div>
                        </div>
                        <small class="help-block"></small>
                        
                        <div class="form-group row">
                                <label for="username" class="col-md-4 control-label text-md-right">{{ __('Sumber Dana') }}</label>
                                <div class="col-md-6">
                                        {{$subAlokasi->sumber_dana}}
                                </div>
                            </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 control-label text-md-right">{{ __('Pagu Alokasi') }}</label>
                            <div class="col-md-6">
                                    {{$subAlokasi->pagu_alokasi}}
                            </div>
                        </div>
                        <small class="help-block"></small>
                    </form>
            </div><!-- /.box-body -->
          </div>
      </td>
      <td width="30%">
        <div class="box box-solid box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">DATA KLASIFIKASI MATA ANGGARAN</h3>
            </div>
            <div style="display: block;" class="box-body">

              @include('admin.layout.catatanKlasifikasi')

            </div><!-- /.box-body -->
          </div>
      </td>
    </tr>
  </table>
          

 <script>
    $('#akun').selectize({
         create: false,
         sortField: 'text'
    });
</script>
         
<script>
    $('#ppk').selectize({
        create: false,
        sortField: 'text'
    });
</script>
@endsection
@section('script')
    


@endsection