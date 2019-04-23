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
        <a href="{{url('klasifikasi/')}}" class="btn btn-warning " role="button">TA : {{$th->tahun}}</a>
        <a href="{{url('klasifikasi/'.$th->tahun.'')}}" class="btn btn-warning" role="button">{{getKode($kegiatan->kode_kegiatan)}}</a>
        <a href="{{url('klasifikasi/'.$th->tahun.'/'.$kegiatan->id_kegiatan.'')}}" class="btn btn-warning" role="button">{{getKode($data_output->kode_output)}}</a>
        <a href="" class="btn btn-primary" role="button">Sub Output</a>
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
              <h3 class="box-title">DATA SUB OUTPUT</h3>
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
                <form id="formKlasifikasi" class="form-horizontal" role="form" method="POST" action="{{ url('/klasifikasi/subOutput/prosesAdd') }}">
                  @csrf
                  <tr class="info">
                    <td></td>
                      <input type="hidden" class="" id="kode_output" name="kode_output" required placeholder="Kode Kegiatan" value="{{$data_output->id_output}}">
                      <input type="hidden" class="" id="tahun" name="tahun" required placeholder="Tahun" value="{{$th->tahun}}">
                      <input type="hidden" class="" id="id_kegiatan" name="id_kegiatan" required placeholder="Kode Kegiatan" value="{{$kegiatan->id_kegiatan}}">

                    <td><input class="" id="kode_sub_output" name="kode_sub_output" required placeholder="Kode Sub Output"></td>
                    <td><input class="" style="width:100%" id="uraian_sub_output" name="uraian_sub_output" required placeholder="Uraian Sub Output"></td>
                    <td>
                      <button type="submit" class="btn btn-primary btn-sm" id="button-reg">Simpan</button>
                    </td>
                  </tr>
                </form>

                <tbody>
                <?php $urut = 1; ?>
                @foreach($data as $subOutput)
                  <a href="{{url('/klasifikasi/subOutput/'.$subOutput->kode_sub_output.'')}}">
                  <tr>
                    <td>{{$urut++}}</td>
                    <td id="row{{$subOutput->kode_sub_output}}" class="success">{{getKode($subOutput->kode_sub_output)}}</td>
                    <td>{{$subOutput->uraian_sub_output}}</td>
                    <td>
                      <div class="btn-group">
                        <a href="" data-toggle="modal" data-target="#edit{{$subOutput->id_sub_output}}" class="btn btn-info btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="" data-toggle="modal" data-target="#hapus{{$subOutput->id_sub_output}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                        <!-- Edit  -->
                        <div class="modal modal-default fade" id="edit{{$subOutput->id_sub_output}}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Data Output</h4>
                              </div>
                              <div class="modal-body">
                                <div class="box-body">
                                  <form  role="form" method="POST" action="{{ url('klasifikasi/subOutput/prosesEdit/'.$subOutput->id_sub_output.'') }}">
                                    @csrf
                                    
                                      <table class="table" width="100%">

                                        <tr>
                                          <td width="30%"><b>Kode Output</b></td>
                                          <td width="70%">
                                            <input class="" id="output" name="output" placeholder="Output" value="{{getKode($data_output->kode_output)}}" required disabled>
                                            <input type="hidden" class="" id="kode_output" name="kode_output" required placeholder="Kode Kegiatan" value="{{$data_output->id_output}}">
                                            <input type="hidden" id="id_sub_output" name="id_sub_output" placeholder="Kegiatan" value="{{$subOutput->id_sub_output}}" required>
                                            <input type="hidden" class="" id="tahun" name="tahun" required placeholder="Tahun" value="{{$th->tahun}}">
                                            <input type="hidden" class="" id="id_kegiatan" name="id_kegiatan" required placeholder="Kode Kegiatan" value="{{$kegiatan->id_kegiatan}}">

                                          </td>
                                        </tr>

                                        <tr>
                                          <td><b>Kode Sub Output</b></td>
                                          <td>
                                            <input class="" id="kode_sub_output" name="kode_sub_output" value="{{getKode($subOutput->kode_sub_output)}}" required placeholder="Kode Output">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td><b>Uraian Sub Output</b></td>
                                          <td>
                                            <input class="" style="width:100%" id="uraian_sub_output" name="uraian_sub_output" value="{{$subOutput->uraian_sub_output}}" required placeholder="Uraian Sub Output">
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

                        <div class="modal modal-warning fade" id="hapus{{$subOutput->id_sub_output}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">HAPUS DATA SUB OUTPUT</h4>
                                  </div>
                                  <div class="modal-body" style="color:#ffffff;">
                                    <form method="POST" action="{{ url('klasifikasi/subOutput/prosesHapus/'.$subOutput->id_sub_output.'') }}">
                                      @csrf
                                      <input type="hidden" name="id" id="id" value="{{ $subOutput->id_sub_output }}">
                                      <input type="hidden" class="" id="tahun" name="tahun" required placeholder="Tahun" value="{{$th->tahun}}">
                                      <input type="hidden" class="" id="id_kegiatan" name="id_kegiatan" required placeholder="Kode Kegiatan" value="{{$kegiatan->id_kegiatan}}">
                                      <input type="hidden" class="" id="kode_output" name="kode_output" required placeholder="Kode Kegiatan" value="{{$data_output->id_output}}">
                                        <p>Apakah anda yakin akan <b>MENGHAPUS</b> referensi Sub Output {{getSubOutput($subOutput->kode_sub_output)}} - {{$subOutput->uraian_sub_output}}?</p>
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
                    $("#row{{$subOutput->kode_sub_output}}").click(function(){
                      window.location = "{{url('/klasifikasi/'.$th->tahun.'/'.$kegiatan->id_kegiatan.'/'.$data_output->id_output.'/'.$subOutput->id_sub_output)}}";
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