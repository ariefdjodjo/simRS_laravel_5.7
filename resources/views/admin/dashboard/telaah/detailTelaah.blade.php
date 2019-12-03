@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{URL::to('/telaah/tambahTelaah/')}}"><i class="fa fa-file"></i> Tambah Telaah</a></li>
            <li class="active">Analisis Harga</li>
          </ol>
@stop
@section('content')
    @if($data->tgl_kirim != NULL)
          <h2>Anda tidak diperbolehkan mengakses data</h2>
    @else
    {{$data->tgl_kirim}}
    <div class="box box-success box-border">
        <div class="box-header">
            <table width="100%">
                <tr>
                    <td width="50%">
                        <div class="btn-group span-6">
                            <a href="{{url::to('telaah/tambahTelaah/'.$id.'/detailTelaah')}}" class="btn btn-success" disabled><i class="fa fa-file-o"></i> Data Telaah</a>
                            
                            @if($harga == 0)
                                <a href="{{url::to('telaah/tambahTelaah/'.$id.'/analisisHarga/proses')}}" class="btn btn-danger"><i class="fa fa-refresh"></i> Analisis Harga</a>
                            @else 
                                <a href="{{url::to('telaah/tambahTelaah/'.$id.'/analisisHarga')}}" class="btn btn-success"><i class="fa fa-refresh"></i> Analisis Harga</a>
                            @endif

                            @if ($qty == 0)
                                <a href="{{url::to('telaah/tambahTelaah/'.$id.'/analisisKebutuhan')}}" class="btn btn-warning"><i class="fa fa-check-square-o"></i> Analisis Kebutuhan</a>
                            @else 
                                <a href="{{url::to('telaah/tambahTelaah/'.$id.'/analisisKebutuhan')}}" class="btn btn-success"><i class="fa fa-check-square-o"></i> Analisis Kebutuhan</a>
                            @endif
                            
                            @if($harga == 0 || $qty == 0)
                                
                            @else 
                                <a href="{{url::to('telaah/kirim/'.$id)}}" class="btn btn-primary"><i class="fa fa-check"></i> Kirim</a>
                            @endif
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th class="warning" style="text-align:center" width="50%"><h4><b> DATA USULAN</b></h4></th>
                    <th class="info" style="text-align:center" width="50%">
                        <h4><b> DATA TELAAH</b></h4>
                    </th>
                </tr>
                <tr>
                    <td>
                        <dl class="dl-horizontal">
                            <dt>No. Usulan</dt>
                            <dd>{{$usulan->no_usulan}}</dd>

                            <dt>Tanggal Usulan</dt>
                            <dd>{{getTfi($usulan->tgl_usulan)}}</dd>

                            <dt>Unit Kerja Pengirim</dt>
                            <dd>{{$usulan->nama_unit_kerja}}</dd>

                            <dt>Penandatangan</dt>
                            <dd>{{$usulan->nama_kepala}}</dd>

                            <dt>Perihal</dt>
                            <dd>{{$usulan->perihal_usulan}}</dd>

                            <dt>isi</dt>
                            <dd><?php echo $usulan->isi_usulan; ?></dd>
                        </dl>
                    </td>
                    <td>
                    <div style="text-align:right"><a data-toggle="modal" data-target="#edit" class="btn btn-primary btn-mn"><i class="fa fa-edit"></i> Edit</a></div>
                        <dl class="dl-horizontal">
                            <dt>No. Telaah</dt>
                            <dd>{{$data->no_telaah}}</dd>

                            <dt>Tanggal Telaah</dt>
                            <dd>{{getTfi($data->tgl_telaah)}}</dd>

                            <dt>Perihal Telaah</dt>
                            <dd>Telaah {{$usulan->perihal_usulan}}</dd>

                            <dt>Analisis Kebutuhan</dt>
                            <dd><?php echo $data->analisis_kebutuhan; ?></dd>

                            <dt>Alasan Kebutuhan</dt>
                            <dd><?php echo $data->alasan_kebutuhan; ?></dd>
                        </dl>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="warning" style="text-align:center"><h4><b>RINCIAN BARANG</b></h4></td>
                </tr>
                <tr>
                    <table class="table table-bordered" id="tbl_barang">
                        <thead>
                            <tr style="text-align:center">
                                <td><b>No</b></td>
                                <td><b>Nama Barang</b></td>
                                <td><b>Spesifikasi</b></td>
                                <td><b>Kebutuhan</b></td>
                                <td><b>Satuan</b></td>
                                <td><b>Harga Satuan</b></td>
                                <td><b>Jumlah</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $urut = 1;
                                $jumlah = 0;
                                $total = 0;    
                            ?>
                            @foreach ($barang as $item)
                            <?php 
                                $jumlah = $item->qty_usulan*$item->harga_usulan;
                                $total+=$jumlah;
                            ?>
                            <tr>
                                <td>{{$urut++}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->spesifikasi}}</td>
                                <td style="text-align:right">{{getNumber($item->qty_usulan)}}</td>
                                <td>{{$item->satuan}}</td>
                                <td style="text-align:right">{{getNumber($item->harga_usulan)}}</td>
                                <td style="text-align:right">{{getNumber($jumlah)}}</td>
                            </tr>    
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" style="text-align:right"><b> TOTAL</b></td>
                                <td style="text-align:right"><b>{{getNumber($total)}}</b></td>
                            </tr>
                        </tfoot>
                    </table>
                </tr>
            </table>
        </div>
    </div>
    @endif
    
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <style type="text/css">
        .modal-dialog {
            width: 90%;
            height: 100%;
            padding: 0;
        }
        .modal-content {
            height: 100%;
            border-radius: 0;
            color:#333;
            overflow:auto;
        }
    </style>

    <!-- Modal Edit -->
    <div class="modal modal-default fade" id="edit">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Edit Data Telaah</h4>
                </div>
                <div class="modal-body">
                  <div class="box-body">
                    <form  role="form" method="POST" class="form-horizontal"  action="{{ url('telaah/editTelaah/'.$data->id_telaah) }}">
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
                <input id="noTelaah" name="noTelaah" type="text" placeholder="Nomor Telaah" value="{{$data->no_telaah}}" class="form-control input-md" required="" >
                <span class="help-block"></span>  
                </div>
              </div>
              
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-2 control-label" for="tglTelaah">Tanggal Telaah</label>  
                <div class="col-md-2">
                <input id="tglTelaah" name="tglTelaah" value="{{$data->tgl_telaah}}" type="text" placeholder="Tanggal Telaah" class="form-control input-md datepicker">
                <span class="help-block"></span>  
                </div>
              </div>
              <script>
                  $(function(){
                      $("#tglTelaah").datepicker({
                        format:'yyyy-mm-dd'
                      });
                  });
                </script>
    
              
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-2 control-label" for="analisis">Telaah/Analisis Kebutuhan</label>  
                <div class="col-md-8">
                <textarea name="analisis" id="analisis" class="form-control input-md">{{$data->analisis_kebutuhan}}</textarea>
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
                <textarea name="alasan" id="alasan" class="form-control input-md">{{$data->alasan_kebutuhan}}</textarea>
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
                    <option value="{{$data->urgency}}">{{getUrgensi($data->urgency)}}</option>
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
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>


@endsection

@section('script')

    <script>
      $(function () {

        $('#tbl_barang').DataTable({"pageLength": 10});

      });

    </script>

@endsection