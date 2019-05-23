@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Usulan</li>
  </ol>
@stop

@section('content')

@if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Usulan</h3>
      </div><!-- /.box-header -->
      
      <div class="box-body">
        <form action="{{url('usulan/prosesTambah')}}" method="POST" class="form-horizontal" name="form_usulan" id="formUsulan">
          @csrf

          <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-2 control-label" for="jenis_usulan">Jenis Usulan</label>
            <div class="col-md-5">
              <select id="jenis_usulan" name="jenis_usulan" class="form-control" required>
                <option value="">-- Pilih Jenis Usulan --</option>
                <option value="5201">Barang Cetakan</option>
                <option value="5202">Barang ATK</option>
                <option value="5203">Barang Rumah Tangga</option>
                <option value="5204">Perbekalan Obat</option>
                <option value="5205">AMHP/BMHP</option>
                <option value="5206">Jasa</option>
                <option value="5301">Investasi Alat Kesehatan</option>
                <option value="5302">Investasi Alat Non Kesehatan</option>
                <option value="5303">Investasi Perangkat Pengolah Data</option>
              </select>
              <script>
                  $('#jenis_usulan').selectize({
                   create: false,
                   sortField: 'text'
                  });
               </script>
            </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="tahun">Jenis Usulan</label>
              <div class="col-md-5">
                <select id="tahun" name="tahun" class="form-control" required>
                  <option value="">-- Pilih Tahun --</option>
                  @foreach ($tahun as $th)
                    <option value="{{$th->tahun}}">{{$th->tahun}}</option>
                  @endforeach
                </select>
                <script>
                    $('#tahun').selectize({
                     create: false,
                     sortField: 'text'
                    });
                 </script>
              </div>
            </div>
          
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-2 control-label" for="no_usulan">Nomor Usulan</label>  
            <div class="col-md-4">
            <input id="no_usulan" name="no_usulan" type="text" placeholder="Nomor Usulan" class="form-control input-md" required="" >
            <span class="help-block"></span>  
            </div>
          </div>
          
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-2 control-label" for="tgl_usulan">Tanggal Usulan</label>  
            <div class="col-md-2">
            <input id="tgl_usulan" name="tgl_usulan" type="text" placeholder="Tanggal Usulan" class="form-control input-md datepicker" required="">
            <span class="help-block"></span>  
            </div>
          </div>
          <script>
              $(function(){
                  $("#tgl_usulan").datepicker({
                    format:'yyyy-mm-dd'
                  });
              });
            </script>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-2 control-label" for="perihal">Perihal</label>  
            <div class="col-md-8">
            <input id="perihal" name="perihal" type="text" placeholder="Perihal" class="form-control input-md" required="">
            <span class="help-block"></span>  
            </div>
          </div>
          
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-2 control-label" for="isi">Isi Usulan</label>  
            <div class="col-md-8">
            <textarea name="isi" id="isi" class="form-control input-md"></textarea>
            <span class="help-block"></span>  
            </div>
          </div>

          <script type="text/javascript">
            $(function(){
              $('#isi').wysihtml5();
            });
            
          </script>
          
          <!-- Select Basic -->
          <div class="form-group">
            <label class="col-md-2 control-label" for="pengirim">Pengirim</label>
            <div class="col-md-4">
              <select id="pengirim" name="pengirim" class="form-control">
                <option value="">Pilih Pengirim</option>
                @foreach ($pengirim as $data)
              <option value="{{$data->id_ttd_usulan}}">{{$data->nama_kepala}} - {{$data->jabatan}}</option>
                @endforeach
              </select>

              <script>
                  $('#pengirim').selectize({
                   create: false,
                   sortField: 'text'
                  });
               </script>

            </div>
          </div>
          <hr>
          <!-- Button (Double) -->
          <div class="form-group">
            <label class="col-md-2 control-label" for="simpan"></label>
            <div class="col-md-8">
              <button id="simpan" name="simpan" class="btn btn-success">Simpan</button>
              <button id="batal" name="batal" class="btn btn-danger">Batal</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

@endsection