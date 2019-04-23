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
        <a href="{{url('klasifikasi/')}}" class="btn btn-warning " role="button">TA : {{$id_tahun}}</a>
        <a href="" class="btn btn-primary" role="button">Kegiatan</a>
        <a href="" class="btn btn-default disabled" role="button">Output</a>
        <a href="" class="btn btn-default disabled" role="button">Sub Output</a>
        <a href="" class="btn btn-default disabled" role="button">Komponen</a>
        <a href="" class="btn btn-default disabled" role="button">Sub Komponen</a>
        <a href="" class="btn btn-default disabled" role="button">Sub Alokasi</a>
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
              <h3 class="box-title">DATA KEGIATAN</h3>
            </div>
            <div style="display: block;" class="box-body">

              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="5%">NO</th>
                    <th width="10%">KODE</th>
                    <th width="65%">URAIAN </th>
                    <th width="20%">#</th>
                  </tr>
                </thead>

                <!-- form -->
                <form id="formProdi" class="form-horizontal" role="form" method="POST" action="{{ url('/klasifikasi/keg/prosesAdd') }}">
                  @csrf
                  <tr class="info">
                    <td></td>
                      <input type="hidden" class="" id="tahun" name="tahun" required placeholder="Tahun" value="{{$id_tahun}}">

                    <td><input class="" id="kode_kegiatan" name="kode_kegiatan" required placeholder="Kode Kegiatan"></td>
                    <td><input class="" style="width:100%" id="uraian_kegiatan" name="uraian_kegiatan" required placeholder="Uraian Kegiatan"></td>
                    <td>
                      <button type="submit" class="btn btn-primary btn-sm" id="button-reg">Simpan</button>
                    </td>
                  </tr>
                </form>

                <tbody>
                <?php $urut = 1; ?>
                @foreach($data as $keg)
                  <a href="{{url('/klasifikasi/keg/'.$keg->kode_kegiatan.'')}}">
                  <tr>
                    <td>{{$urut++}}</td>
                    <td id="row{{$keg->kode_kegiatan}}" class="success">{{getKegiatan($keg->kode_kegiatan)}}</td>
                    <td>{{$keg->uraian_kegiatan}}</td>
                    <td>
                      <div class="btn-group">
                        <a href="" data-toggle="modal" data-target="#edit{{$keg->id_kegiatan}}" class="btn btn-info btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="" data-toggle="modal" data-target="#hapus{{$keg->id_kegiatan}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                        <!-- Edit  -->
                        <div class="modal modal-default fade" id="edit{{$keg->id_kegiatan}}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Data Kegiatan</h4>
                              </div>
                              <div class="modal-body">
                                <div class="box-body">
                                  <form  role="form" method="POST" action="{{ url('klasifikasi/keg/prosesEdit/'.$keg->id_kegiatan.'') }}">
                                    @csrf
                                    
                                      <table class="table" width="100%">

                                        <tr>
                                          <td width="30%"><b>Tahun</b></td>
                                          <td width="70%">
                                            <input class="" id="th" name="th" placeholder="Tahun" value="{{$keg->tahun}}" required disabled>
                                            <input type="hidden" id="id" name="id" placeholder="Tahun" value="{{$keg->id_kegiatan}}" required>
                                            <input type="hidden" id="tahun" name="tahun" placeholder="Tahun" value="{{$keg->tahun}}" required>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td><b>Kode Kegiatan</b></td>
                                          <td>
                                            <input class="" id="kode_kegiatan" name="kode_kegiatan" value="{{getKegiatan($keg->kode_kegiatan)}}" required placeholder="Kode Program">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td><b>Uraian Kegiatan</b></td>
                                          <td>
                                            <input class="" style="width:100%" id="uraian_kegiatan" name="uraian_kegiatan" value="{{$keg->uraian_kegiatan}}" required placeholder="Uraian Program">
                                          </td>
                                        </tr>

                                      </table>
                                        
                                    
                                    <div class="form-group row mb-0">
                                        <label for="username" class="col-md-4 col-form-label"></label>
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Simpan') }}
                                            </button>
                                        </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Hapus -->

                        <div class="modal modal-warning fade" id="hapus{{$keg->id_kegiatan}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">HAPUS DATA TAHUN ANGGARAN</h4>
                                  </div>
                                  <div class="modal-body" style="color:#ffffff;">
                                    <form method="POST" action="{{ url('klasifikasi/keg/prosesHapus/'.$keg->id_kegiatan.'/'.$keg->tahun.'') }}">
                                      @csrf
                                      <input type="hidden" name="id" id="id" value="{{ $keg->id_kegiatan }}">
                                        <p>Apakah anda yakin akan <b>MENGHAPUS</b> referensi Kegiatan {{getKegiatan($keg->kode_kegiatan)}} - {{$keg->uraian_kegiatan}}?</p>
                                      <br>
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                      <button type="submit" class="btn btn-primary" id="button-reg">Ya</button>
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                    
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal --> 

                      </div>
                    </td>
                  </tr>
                  </a>

                  <script type="text/javascript">
                    $("#row{{$keg->kode_kegiatan}}").click(function(){
                       window.location = "{{url('/klasifikasi/'.$keg->tahun.'/'.$keg->id_kegiatan.'')}}";
                     });
                  </script>
                @endforeach  
                </tbody>

              </table>

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
          


             
@endsection
@section('script')



@endsection