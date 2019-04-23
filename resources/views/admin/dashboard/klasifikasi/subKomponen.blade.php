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
        <a href="{{url('klasifikasi/')}}" class="btn btn-warning " role="button">TA : {{$tahun->tahun}}</a>
        <a href="{{url('klasifikasi/'.$tahun->tahun.'')}}" class="btn btn-warning" role="button">{{getKode($kegiatan->kode_kegiatan)}}</a>
        <a href="{{url('klasifikasi/'.$tahun->tahun.'/'.$kegiatan->kode_kegiatan.'')}}" class="btn btn-warning" role="button">{{getKode($output->kode_output)}}</a>
        <a href="{{url('klasifikasi/'.$tahun->tahun.'/'.$kegiatan->id_kegiatan.'/'.$output->id_output.'')}}" class="btn btn-warning" role="button">{{getKode($data_subOutput->kode_sub_output)}}</a>
        <a href="{{url('klasifikasi/'.$tahun->tahun.'/'.$kegiatan->id_kegiatan.'/'.$output->id_output.'/'.$data_subOutput->id_sub_output.'')}}" class="btn btn-warning" role="button">{{getKode($data_komponen->kode_komponen)}}</a>
        <a href="" class="btn btn-primary" role="button">Sub Komponen</a>
        <a href="" class="btn btn-default disabled" role="button">Sub Alokasi</a>
      </div>
    </div>
  </div>

  <table class="table" width="100%">
    <tr>
      <td width="70%">
        <div class="box ">
            <div class="box-header with-border">
              <h3 class="box-title">DATA OUTPUT</h3>
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
                <form id="formKlasifikasi" class="form-horizontal" role="form" method="POST" action="{{ url('/klasifikasi/subKomponen/prosesAdd') }}">
                  @csrf
                  <tr class="info">
                    <td></td>
                      <input type="hidden" class="" id="kode_komponen" name="kode_komponen" required placeholder="Kode Kegiatan" value="{{$data_komponen->id_komponen}}">
                      <input type="hidden" class="" id="kode_sub_output" name="kode_sub_output" required placeholder="Kode Kegiatan" value="{{$data_subOutput->id_sub_output}}">
                      <input type="hidden" class="" id="kode_output" name="kode_output" required placeholder="Kode Kegiatan" value="{{$output->id_output}}">
                      <input type="hidden" class="" id="tahun" name="tahun" required placeholder="Tahun" value="{{$tahun->tahun}}">
                      <input type="hidden" class="" id="id_kegiatan" name="id_kegiatan" required placeholder="Kode Kegiatan" value="{{$kegiatan->id_kegiatan}}">

                    <td><input class="" id="kode_sub_komponen" name="kode_sub_komponen" required placeholder="Kode Sub Komponen"></td>
                    <td><input class="" style="width:100%" id="uraian_sub_komponen" name="uraian_sub_komponen" required placeholder="Uraian Sub Komponen"></td>
                    <td>
                      <button type="submit" class="btn btn-primary btn-sm" id="button-reg">Simpan</button>
                    </td>
                  </tr>
                </form>

                <tbody>
                <?php 
                    $urut = 1; 
                ?>
                @foreach($data as $keg)
                  <a href="{{url('/klasifikasi/komponen/'.$keg->kode_sub_komponen.'')}}">
                  <tr>
                    <td>{{$urut++}}</td>
                    <td id="row{{$keg->id_sub_komponen}}" class="success">{{getKode($keg->kode_sub_komponen)}}</td>
                    <td>{{$keg->uraian_sub_komponen}}</td>
                    <td>
                      <div class="btn-group">
                        <a href="" data-toggle="modal" data-target="#edit{{$keg->id_sub_komponen}}" class="btn btn-info btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="" data-toggle="modal" data-target="#hapus{{$keg->id_sub_komponen}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                        <!-- Edit  -->
                        <div class="modal modal-default fade" id="edit{{$keg->id_sub_komponen}}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Data Sub Komponen</h4>
                              </div>
                              <div class="modal-body">
                                <div class="box-body">
                                  <form  role="form" method="POST" action="{{ url('klasifikasi/subKomponen/prosesEdit/'.$keg->id_sub_komponen.'') }}">
                                    @csrf
                                    
                                      <table class="table" width="100%">

                                        <tr>
                                          <td width="30%"><b>Kode Sub Komponen</b></td>
                                          <td width="70%">
                                            <input class="" id="komponen" name="komponen" placeholder="Kode Komponen" value="{{getKode($data_komponen->kode_komponen)}}" required disabled>
                                            <input type="hidden" class="" id="kode_komponen" name="kode_komponen" required placeholder="Kode Kegiatan" value="{{$data_komponen->id_komponen}}">
                                            <input type="hidden" class="" id="kode_sub_output" name="kode_sub_output" required placeholder="Kode Kegiatan" value="{{$data_subOutput->id_sub_output}}">
                                            <input type="hidden" class="" id="kode_output" name="kode_output" required placeholder="Kode Kegiatan" value="{{$output->id_output}}">
                                            <input type="hidden" class="" id="tahun" name="tahun" required placeholder="Tahun" value="{{$tahun->tahun}}">
                                            <input type="hidden" class="" id="id_kegiatan" name="id_kegiatan" required placeholder="Kode Kegiatan" value="{{$kegiatan->id_kegiatan}}">
                                            <input type="hidden" id="id_sub_komponen" name="id_sub_komponen" placeholder="Kode Sub Komponen" value="{{$keg->id_sub_komponen}}" required>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td><b>Kode Sub Komponen</b></td>
                                          <td>
                                            <input class="" id="kode_sub_komponen" name="kode_sub_komponen" value="{{getKode($keg->kode_sub_komponen)}}" required placeholder="Kode Sub Komponen">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td><b>Uraian Sub Komponen</b></td>
                                          <td>
                                            <input class="" style="width:100%" id="uraian_sub_komponen" name="uraian_sub_komponen" value="{{$keg->uraian_sub_komponen}}" required placeholder="Uraian Sub Komponen">
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

                        <div class="modal modal-warning fade" id="hapus{{$keg->id_sub_komponen}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">HAPUS DATA SUB KOMPONEN</h4>
                                  </div>
                                  <div class="modal-body" style="color:#ffffff;">
                                    <form method="POST" action="{{ url('klasifikasi/subKomponen/prosesHapus/'.$keg->id_sub_komponen.'') }}">
                                      @csrf
                                      <input type="hidden" name="id" id="id" value="{{ $keg->id_sub_komponen }}">
                                      <input type="hidden" class="" id="kode_komponen" name="kode_komponen" required placeholder="Kode Kegiatan" value="{{$data_komponen->id_komponen}}">
                                            <input type="hidden" class="" id="kode_sub_output" name="kode_sub_output" required placeholder="Kode Kegiatan" value="{{$data_subOutput->id_sub_output}}">
                                            <input type="hidden" class="" id="kode_output" name="kode_output" required placeholder="Kode Kegiatan" value="{{$output->id_output}}">
                                            <input type="hidden" class="" id="tahun" name="tahun" required placeholder="Tahun" value="{{$tahun->tahun}}">
                                            <input type="hidden" class="" id="id_kegiatan" name="id_kegiatan" required placeholder="Kode Kegiatan" value="{{$kegiatan->id_kegiatan}}">
                                        <p>Apakah anda yakin akan <b>MENGHAPUS</b> referensi Komponen {{getSubKomponen($keg->kode_sub_komponen)}} - {{$keg->uraian_sub_komponen}}?</p>
                                        <p>Dengan menghapus data ini, secara otomatis akan menghapus data-data terkait seperti Komponen dll</p>
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
                    $("#row{{$keg->id_sub_komponen}}").click(function(){
                      window.location = "{{url('/klasifikasi/'.$tahun->tahun.'/'.$kegiatan->id_kegiatan.'/'.$output->id_output.'/'.$data_subOutput->id_sub_output).'/'.$data_komponen->id_komponen.'/'.$keg->id_sub_komponen}}";
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