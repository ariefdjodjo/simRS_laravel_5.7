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
        <a href="" class="btn btn-primary " role="button">Tahun Anggaran</a>
        <a href="" class="btn btn-default disabled" role="button">Kegiatan</a>
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
              <h3 class="box-title">DATA TAHUN ANGGARAN</h3>
            </div>
            <div style="display: block;" class="box-body">

              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="5%">NO</th>
                    <th width="10%">TAHUN</th>
                    <th width="20%">KODE</th>
                    <th width="40%">URAIAN </th>
                    <th width="20%">#</th>
                  </tr>
                </thead>

                <!-- form -->
                <form id="formProdi" class="form-horizontal" role="form" method="POST" action="{{ url('/klasifikasi/prosesAdd') }}">
                  @csrf
                  <tr class="info">
                    <td></td>
                    <td><input class="" id="tahun" name="tahun" required placeholder="Tahun"></td>
                    <td><input class="" id="kode_program" name="kode_program" required placeholder="Kode Program"></td>
                    <td><input class="" style="width:100%" id="uraian_program" name="uraian_program" required placeholder="Uraian Program"></td>
                    <td>
                      <button type="submit" class="btn btn-primary btn-sm" id="button-reg">Simpan</button>
                    </td>
                  </tr>
                </form>

                <tbody>
                <?php $urut = 1; ?>
                @foreach($data as $tahun)
                  <tr>
                    <td>{{$urut++}}</td>
                    <td id="row{{$tahun->tahun}}" class="success">{{$tahun->tahun}}</td>
                    <td>{{$tahun->kode_program}}</td>
                    <td>{{$tahun->uraian_program}}</td>
                    <td>
                      <div class="btn-group">
                        <a href="" data-toggle="modal" data-target="#edit{{$tahun->tahun}}" class="btn btn-info btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="" data-toggle="modal" data-target="#hapus{{$tahun->tahun}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                        <!-- Edit  -->
                        <div class="modal modal-default fade" id="edit{{$tahun->tahun}}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Data Tahun Anggaran</h4>
                              </div>
                              <div class="modal-body">
                                <div class="box-body">
                                  <form  role="form" method="POST" action="{{ url('klasifikasi/prosesEdit/'.$tahun->tahun.'') }}">
                                    @csrf
                                    
                                      <table class="table" width="100%">

                                        <tr>
                                          <td width="30%"><b>Tahun</b></td>
                                          <td width="70%">
                                            <input class="" id="th" name="th" placeholder="Tahun" value="{{$tahun->tahun}}" disabled>
                                            <input type="hidden" id="tahun" name="tahun" placeholder="Tahun" value="{{$tahun->tahun}}">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td><b>Kode Program</b></td>
                                          <td>
                                            <input class="" id="kode_program" name="kode_program" value="{{$tahun->kode_program}}" required placeholder="Kode Program">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td><b>Uraian Program</b></td>
                                          <td>
                                            <input class="" style="width:100%" id="uraian_program" name="uraian_program" value="{{$tahun->uraian_program}}" required placeholder="Uraian Program">
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

                        <div class="modal modal-warning fade" id="hapus{{$tahun->tahun}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">HAPUS DATA TAHUN ANGGARAN</h4>
                                  </div>
                                  <div class="modal-body" style="color:#ffffff;">
                                    <form method="POST" action="{{ url('klasifikasi/prosesHapus/'.$tahun->tahun.'') }}">
                                      @csrf
                                      <input type="hidden" name="id" id="id" value="{{ $tahun->tahun }}">
                                        <p>Apakah anda yakin akan <b>MENGHAPUS</b> referensi Tahun Anggaran {{$tahun->tahun}}?</p>
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


                  <script type="text/javascript">
                    $("#row{{$tahun->tahun}}").click(function(){
                       window.location = "{{url('/klasifikasi/'.$tahun->tahun.'')}}";
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