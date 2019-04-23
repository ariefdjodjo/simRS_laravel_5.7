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
            <a href="" class="btn btn-primary" role="button">Sub Alokasi</a>
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
            <div style="padding:0 0 10px 0"><a href="{{url('klasifikasi/addSA/'.$datath->tahun.'/'.$datakegiatan->id_kegiatan.'/'.$dataoutput->id_output.'/'.$datasubOutput->id_sub_output.'/'.$datakomponen->id_komponen.'/'.$datasubKomponen->id_sub_komponen)}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Sub Alokasi</a></div>
                <table class="table table-bordered" id="dataSubAlokasi">
                    <thead>
                        <tr>
                          <td>No</td>
                          <td>Sub Alokasi</td>
                          <td>Kode MA</td>
                          <td>Pagu Alokasi</td>
                          <td>#</td>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $urut = 1; 
                        $total =0;
                      ?>
                      @foreach ($subAlokasi as $data)
                        <tr>
                          <td>{{$urut++}}</td>
                          <td>{{$data->uraian_sub_alokasi}}</td>
                          <td>{{getMa($data->id_sub_alokasi)}}</td>
                          <td style="text-align:right;">{{getNumber($data->pagu_alokasi)}}</td>
                          <td>
                            <div class="btn-group">
                              <a href="{{url('detailSA/'.$data->id_sub_alokasi)}}" class="btn btn-info btn-sm" title="Lihat Detail"><i class="fa fa-search"></i></a>
                              <a href="{{url('editSA/'.$data->id_sub_alokasi)}}" class="btn btn-primary btn-sm" title="Edit Data"><i class="fa fa-edit"></i></a>
                                <a href="" data-toggle="modal" data-target="#hapus{{$data->id_sub_alokasi}}" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                            </div>

                            <div class="modal modal-warning fade" id="hapus{{$data->id_sub_alokasi}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">HAPUS DATA SUB ALOKASI</h4>
                                  </div>
                                  <div class="modal-body" style="color:#ffffff;">
                                    <form method="POST" action="{{ url('klasifikasi/prosesHapus/'.$data->id_sub_alokasi.'') }}">
                                      @csrf
                                <input type="hidden" class="" name="tahun" id="tahun" value="{{$data->tahun}}">
                                <input Type="hidden" id="kode_kegiatan" name="kode_kegiatan" value="{{$data->id_kegiatan}}" required autofocus>
                                <input Type="hidden" id="kode_output" name="kode_output" value="{{$data->id_output}}" required autofocus>
                                <input Type="hidden" id="kode_sub_output" name="kode_sub_output" value="{{$data->id_sub_output}}" required autofocus>
                                <input Type="hidden" id="kode_komponen" name="kode_komponen" value="{{$data->id_komponen}}" required autofocus>
                                <input Type="hidden" id="kode_sub_komponen" name="kode_sub_komponen" value="{{$data->id_sub_komponen}}" required autofocus>
                                      <input type="hidden" name="id" id="id" value="{{ $data->id_sub_alokasi }}">
                                        <p>Apakah anda yakin akan <b>MENGHAPUS</b> Data Sub Alokasi {{$data->uraian_sub_alokasi}}?</p>
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
                          </td>
                        </tr>
                        <?php $total+= $data->pagu_alokasi; ?>  
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:right;">{{getNumber($total)}}</td>
                        <td></td>
                      </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
          </div>
      </td>
    </tr>
  </table>
          


             
@endsection
@section('script')

<script>
      $(function () {
        $('#dataSubAlokasi').DataTable({"pageLength": 10});
      });

</script>

@endsection