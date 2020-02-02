@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tambah Telaah</li>
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
        <h3 class="box-title">Tambah Telaah</h3>
      </div><!-- /.box-header -->
      
      <div class="box-body">
        <form action="{{url('telaah/tambahTelaah/tambah')}}" method="POST" class="form-horizontal" name="formTelaah" id="formTelaah">
          @csrf

          <!-- Select Basic -->
          <div class="form-group">
            <label class="col-md-2 control-label" for="tahun">Tahun Anggaran</label>
            <div class="col-md-5">
              <input type="text" value="{{$usulan->tahun}}" class="form-control input-md" disabled>
              <input type="hidden" name="tahun" id="tahun" value="{{$usulan->tahun}}" class="form-control input-md">
            </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="noUsulan">Nomor Usulan</label>
              <div class="col-md-5">
                <input class="form-control" value="{{$usulan->no_usulan}}" disabled>
                <input id="noUsulan" name="noUsulan" type="hidden" class="form-control  input-md" value="{{$usulan->id_usulan}}">
              </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="noUsulan"></label>
              <div class="col-md-10">
              <abbr>
                  <dl class="dl-horizontal">
                    <dt>No. Usulan</dt>
                    <dd>{{$usulan->no_usulan}}</dd>

                    <dt>Perihal Usulan</dt>
                    <dd>{{$usulan->perihal_usulan}}</dd>
                  </dl>
              </abbr>
              </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-2 control-label" for="noTelaah">Nomor Telaah</label>  
            <div class="col-md-4">
            <input id="noTelaah" name="noTelaah" type="text" placeholder="Nomor Telaah" value="KU.02.01/III/" class="form-control input-md" required="" >
            <span class="help-block"></span>  
            </div>
          </div>
          
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-2 control-label" for="tglTelaah">Tanggal Telaah</label>  
            <div class="col-md-2">
            <input id="tglTelaah" name="tglTelaah" value="{{getNow()}}" type="text" placeholder="Tanggal Telaah" class="form-control input-md datepicker">
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
            <label class="col-md-2 control-label" for="analisis">Telaah/Analisis Kebutuhan</label>  
            <div class="col-md-8">
            <textarea name="analisis" id="analisis" class="form-control input-md"></textarea>
            <span class="help-block"></span>  
            </div>
          </div>

          <script type="text/javascript">
            $(function(){
              $('#analisis').wysihtml5();
            });
          </script>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-2 control-label" for="alasan">Alasan Kebutuhan</label>  
            <div class="col-md-8">
            <textarea name="alasan" id="alasan" class="form-control input-md"></textarea>
            <span class="help-block"></span>  
            </div>
          </div>

          <script type="text/javascript">
            $(function(){
              $('#alasan').wysihtml5();
            });
          </script>
          
          
          <!-- Select Basic -->
          <div class="form-group">
            <label class="col-md-2 control-label" for="urgensi">Urgensi</label>
            <div class="col-md-4">
              <select id="urgensi" name="urgensi" class="form-control" required> 
                <option value="1">Biasa</option>  
                <option value="2">Segera</option>
                <option value="3">Rahasia</option>
              </select>

              <script>
                  $('#urgensi').selectize({
                   create: false,
                   sortField: 'text'
                  });
               </script>

            </div>
          </div>

          <!-- Select Basic -->
          <div class="form-group">
            <label class="col-md-2 control-label" for="pengirim">Pengirim</label>
            <div class="col-md-9">
              <select id="pengirim" name="pengirim" class="form-control">
                @foreach ($ttdTelaah as $data)
                  <option value="{{$data->id_ttd_telaah}}">{{$data->nama_penelaah}} - {{$data->jabatan}}</option>
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

    <script>
      $(function () {

        $('#dataAkun').DataTable({"pageLength": 10});

      });

    </script>

@endsection