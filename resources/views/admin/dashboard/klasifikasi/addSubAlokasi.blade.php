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
            <a href="{{url('klasifikasi/')}}" class="btn btn-warning " role="button">TA : {{$th}}</a>
            <a href="{{url('klasifikasi/'.$th.'')}}" class="btn btn-warning" role="button">{{getKode($datakegiatan->kode_kegiatan)}}</a>
            <a href="{{url('klasifikasi/'.$th.'/'.$datakegiatan->id_kegiatan.'')}}" class="btn btn-warning" role="button">{{getKode($dataoutput->kode_output)}}</a>
            <a href="{{url('klasifikasi/'.$th.'/'.$datakegiatan->id_kegiatan.'/'.$dataoutput->id_output.'')}}" class="btn btn-warning" role="button">{{getKode($datasubOutput->kode_sub_output)}}</a>
            <a href="{{url('klasifikasi/'.$th.'/'.$datakegiatan->id_kegiatan.'/'.$dataoutput->id_output.'/'.$datasubOutput->id_sub_output.'')}}" class="btn btn-warning" role="button">{{getKode($datakomponen->kode_komponen)}}</a>
            <a href="{{url('klasifikasi/'.$th.'/'.$datakegiatan->id_kegiatan.'/'.$dataoutput->id_output.'/'.$datasubOutput->id_sub_output.'/'.$datakomponen->id_komponen)}}" class="btn btn-warning" role="button">{{getKode($datasubKomponen->kode_sub_komponen)}}</a>
            <a href="{{url('klasifikasi/'.$datath->tahun.'/'.$datakegiatan->id_kegiatan.'/'.$dataoutput->id_output.'/'.$datasubOutput->id_sub_output.'/'.$datakomponen->id_komponen.'/'.$datasubKomponen->id_sub_komponen)}}" class="btn btn-primary" role="button">{{$datasubKomponen->uraian_sub_komponen}}</a>
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
                                {{$datath->tahun}}
                                <input type="hidden" class="" name="tahun" id="tahun" value="{{$datath->tahun}}">
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
                                {{getKode($datakegiatan->kode_kegiatan)}} - {{$datakegiatan->uraian_kegiatan}}
                            <input Type="hidden" id="kode_kegiatan" name="kode_kegiatan" value="{{$datakegiatan->id_kegiatan}}" required autofocus>
                                <small class="help-block"></small>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label for="kode_output" class="col-md-4 control-label">{{ __('Kode Output') }}</label>
            
                            <div class="col-md-6">
                                {{getKode($dataoutput->kode_output)}} - {{$dataoutput->uraian_output}}
                            <input Type="hidden" id="kode_output" name="kode_output" value="{{$dataoutput->id_output}}" required autofocus>
                                <small class="help-block"></small>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label for="kode_sub_output" class="col-md-4 control-label">{{ __('Kode Output') }}</label>
            
                            <div class="col-md-6">
                                {{getKode($datasubOutput->kode_sub_output)}} - {{$datasubOutput->uraian_sub_output}}
                            <input Type="hidden" id="kode_sub_output" name="kode_sub_output" value="{{$datasubOutput->id_sub_output}}" required autofocus>
                                <small class="help-block"></small>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label for="kode_komponen" class="col-md-4 control-label">{{ __('Kode Komponen') }}</label>
            
                            <div class="col-md-6">
                                {{getKode($datakomponen->kode_komponen)}} - {{$datakomponen->uraian_komponen}}
                            <input Type="hidden" id="kode_komponen" name="kode_komponen" value="{{$datakomponen->id_komponen}}" required autofocus>
                                <small class="help-block"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kode_sub_komponen" class="col-md-4 control-label">{{ __('Kode Sub Komponen') }}</label>
            
                            <div class="col-md-6">
                                {{getKode($datasubKomponen->kode_sub_komponen)}} - {{$datasubKomponen->uraian_sub_komponen}}
                            <input Type="hidden" id="kode_sub_komponen" name="kode_sub_komponen" value="{{$datasubKomponen->id_sub_komponen}}" required autofocus>
                                <small class="help-block"></small>
                            </div>
                        </div>
            
                        <div class="form-group row">
                            <label for="username" class="col-md-4 control-label text-md-right">{{ __('Kode Akun') }}</label>
                            <div class="col-md-6">
                                <select id="akun" name="akun" class="form-control" required>
                                    <option value="">--Pilih Kode Akun--</option>
                                    $@foreach ($dataAkun as $data)
                                        <option value="{{ $data->id_akun }}">{{ $data->kode_akun }} - {{ $data->uraian_akun }}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="username" class="col-md-4 control-label text-md-right">{{ __('PPK') }}</label>
                            <div class="col-md-6">
                                <select id="ppk" name="ppk" class="form-control" required>
                                    <option value="">-- Pilih PPK --</option>
                                    $@foreach ($dataPpk as $ppk)
                                        <option value="{{ $ppk->id_ppk }}">{{ $ppk->nama_ppk }}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 control-label text-md-right">{{ __('Uraian Sub Alokasi') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="uraian_sub_alokasi" id="uraian_sub_alokasi" placeholder="Uraian Sub Alokasi" required>
                            </div>
                        </div>
                        <small class="help-block"></small>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 control-label text-md-right">{{ __('Pagu Alokasi') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="pagu_alokasi" id="pagu_alokasi" placeholder="Pagu" required>
                            </div>
                        </div>
                        <small class="help-block"></small>
                        
                        <div class="form-group row mb-0">
                            <label for="username" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </div>
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