@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{URL::to('/tambahUsulan')}}"><i class="fa fa-plus"></i> Usulan</a></li>
    <li class="active">Item Barang Usulan</li>
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

<?php 
    $urut = 1;
    $urut_barang = 1;
    $total = 0;
?>
<div class="box">
    <h3 align="center"><b>DATA USULAN PENGADAAN</b></h3>
    <hr>
    <div class="pull-right"><a href="../usulan/detail/{{$usulan->id_usulan}}" class="btn btn-warning">Selesai</a></div>
</div>
<table width="100%" style="padding:5px" class="table">
    <tr>
        <td width="50%" valign="top">
            <div>
                <div class="box box-solid box-primary">
                    <div class="box-header">
                        DATA USULAN
                    </div>
                    <div class="box-body">
                        <div class="pull-right"><a href="../editUsulan/{{$usulan->id_usulan}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a></div>
                        <dl class="dl-horizontal">
                            <dt>Tahun</dt>
                            <dd>{{$usulan->tahun}}</dd>

                            <dt>No. Usulan</dt>
                            <dd>{{$usulan->no_usulan}}</dd>

                            <dt>Tanggal Usulan</dt>
                            <dd>{{getTfi($usulan->tgl_usulan)}}</dd>

                            <dt>Perihal Usulan</dt>
                            <dd>{{$usulan->perihal_usulan}}</dd>

                            <dt>Jenis Usulan</dt>
                            <dd>{{getJenis($usulan->jenis_usulan)}}</dd>

                            <dt>Isi Usulan</dt>
                            <dd><?php echo $usulan->isi_usulan; ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </td>
        <td width="50%" valign="top">
            <div>
                <div class="box box-solid box-success">
                    <div class="box-header">
                        <div class="btn-group">
                            Lampiran
                        </div>
                    </div>
                    <div class="box-body">
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('usulan/tambahLampiran/'.$usulan->id_usulan.'') }}">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="buttondropdown">Lampiran</label>
                                <div class="col-md-9">
                                <div class="input-group">
                                    <input id="file" name="file" class="form-control" placeholder="placeholder" type="file" required="">
                                    <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <table class="table table-bordered">
                            <tr>
                                <td>NO</td>
                                <td>NAMA</td>
                                <td>#</td>
                            </tr>

                            @foreach($lampiran as $lamp)
                            <tr>
                                <td>{{$urut++}}</td>
                                <td>{{$lamp->nama_dokumen}}</td>
                                <td><a href="{{url::to('hapusLampiran/'.$lamp->id_usulan.'/'.$lamp->id_lampiran_usulan)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div>
                <div class="box box-solid box-info">
                    <div class="box-header">
                        ITEM BARANG
                    </div>
                    <div class="box-body">
                        <div class="box-tools pull-right">
                            <a data-toggle="modal" data-target="#tambahBarang" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Barang</a>
                        </div>
                        <br>
                        <hr>
                        <table class="table table-bordered" id="itemBarang">
                            <thead>
                                <tr>
                                    <td>NO</td>
                                    <td>NAMA BARANG</td>
                                    <td>SPESIFIKASI</td>
                                    <td>KEBUTUHAN</td>
                                    <td>SATUAN</td>
                                    <td>HARGA SATUAN</td>
                                    <td>JUMLAH</td>
                                    <td>#</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barang as $item)
                                <tr>
                                    <td>{{$urut_barang++}}</td>
                                    <td>{{$item->nama_barang}}</td>
                                    <td>{{$item->spesifikasi}}</td>
                                    <td style="text-align:right">{{getNumber($item->qty_usulan)}}</td>
                                    <td>{{$item->satuan}}</td>
                                    <td style="text-align:right">{{getNumber($item->harga_usulan)}}</td>
                                    <td style="text-align:right">{{getNumber($item->jumlah_usulan)}}</td>

                                    <?php
                                        $total+=$item->jumlah_usulan;
                                    ?>

                                    <td>
                                        <a data-toggle="modal" data-target="#editBarang{{$item->id_barang_usulan}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="../usulan/hapusBarang/{{$item->id_barang_usulan}}/{{$item->id_usulan}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                        <!-- modal Edit barang -->
                                            <div class="modal modal-default fade" id="editBarang{{$item->id_barang_usulan}}">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Edit Barang</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="box-body">
                                                        <form class="form-horizontal" id="form_edit" name="form-edit" method="POST" action="{{ url('usulan/editBarang/'.$item->id_barang_usulan.'/'.$item->id_usulan) }}">
                                                        @csrf
                                                        
                                                        <table class="table" width="100%">
                                                                <tr>
                                                                  <td width="30%"><b>Nama Barang</b></td>
                                                                  <td width="70%">
                                                                    <select name="nama_barang" id="nama_barang{{$item->id_barang_usulan}}">
                                                                        <option value="{{$item->nama_barang}}">{{$item->nama_barang}}</option>
                                                                        <option value="">--Pilih Barang--</option>
                                                                        @foreach ($mstBarang as $barang)
                                                                              <option value="{{$barang->nama_barang}}">{{$barang->nama_barang}}</option>
                                                                        @endforeach
                                                                    </select>
                                          
                                                                      <script>
                                                                          $('#nama_barang{{$item->id_barang_usulan}}').selectize({
                                                                           create: true,
                                                                           sortField: 'text'
                                                                          });
                                                                      </script>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td valign="top"><b>Spesifikasi</b></td>
                                                                  <td>
                                                                    <textarea name="spesifikasi" id="spesifikasi" class="form-control" cols="40">{{$item->spesifikasi}}</textarea>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td><b>Kebutuhan</b></td>
                                                                  <td>
                                                                    <input id="kebutuhan" type="text" name="kebutuhan" class="form-control input-md" value="{{$item->qty_usulan}}" required autofocus placeholder="Kebutuhan">
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b> Satuan</b></td>
                                                                    <td>
                                                                          <select name="satuan" id="satuan{{$item->id_barang_usulan}}"  class="form-control" style="width:100px" required>
                                                                            <option value="{{$item->satuan}}">{{$item->satuan}}</option>  
                                                                            <option value="">-- pilih Satuan --</option>
                                                                              <option value="Kilogram">Kilogram</option>
                                                                              <option value="m2">m2</option>
                                                                              <option value="Gram">Gram</option>
                                                                              <option value="Amp">Amp</option>
                                                                              <option value="Tablet">Tablet</option>
                                                                              <option value="mg">mg</option>
                                                                              <option value="inj">inj</option>
                                                                              <option value="Unit">Unit</option>
                                                                              <option value="Buah">Buah</option>
                                                                              <option value="Paket">Paket</option>
                                                                              <option value="Rim">Rim</option>
                                                                              <option value="Box">Box</option>
                                                                              <option value="Dosin">Dosin</option>
                                                                              <option value="Lembar">Lembar</option>
                                                                              <option value="Botol">Botol</option>
                                                                              <option value="Pcs">Pcs</option>
                                                                              <option value="Liter">Liter</option>
                                                                              <option value="ml">ml</option>
                                                                          </select>
                                                                          
                                                                          <script>
                                                                              $('#satuan{{$item->id_barang_usulan}}').selectize({
                                                                                  create: false,
                                                                                  sortField: 'text'
                                                                              });
                                                                          </script>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Harga Satuan</b></td>
                                                                    <td>
                                                                    <input type="text" name="harga" id="harga" class="form-control" value="{{$item->harga_usulan}}" placeholder="Harga Satuan" required>
                                                                    </td>
                                                                </tr>
                                          
                                                                <tr>
                                                                    <td>Catatan</td>
                                                                    <td><textarea name="catatan" id="catatan" class="form-control col-md">{{$item->catatan_usulan}}</textarea></td>
                                                                </tr>
                                                                
                                                              </table>

                                                        <div class="form-group row mb-0">
                                                            <label for="simpan" class="col-md-4 col-form-label"></label>
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
                                                <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>

                                    </td>
                                </tr>    
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">TOTAL</td>
                                    <td  style="text-align:right">{{getNumber($total)}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>

<!-- modal tambah barang -->
<div class="modal modal-default fade" id="tambahBarang">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Barang</h4>
            </div>
            <div class="modal-body">
              <div class="box-body">
                <form  role="form" method="POST" action="{{ url('usulan/tambahBarang/'.$usulan->id_usulan) }}">
                  @csrf
                  
                    <table class="table" width="100%">
                      <tr>
                        <td width="30%"><b>Nama Barang</b></td>
                        <td width="70%">
                          <select name="namaBarang" id="namaBarang">
                              <option value="">--Pilih Barang--</option>
                              @foreach ($mstBarang as $barang)
                                    <option value="{{$barang->id_master_barang}}">{{$barang->nama_barang}}</option>
                              @endforeach
                          </select>
                          <input type="hidden" name="nama_barang" id="nama_barang" >
                        </td>
                      </tr>
                      <tr>
                        <td valign="top"><b>Spesifikasi</b></td>
                        <td>
                          <textarea name="spesifikasi" id="spesifikasi" class="form-control col-md"></textarea>
                        </td>
                      </tr>
                      <tr>
                        <td><b>Kebutuhan</b></td>
                        <td>
                          <input id="kebutuhan" type="text" name="kebutuhan" class="form-control input-md" value="{{ old('kebutuhan') }}" required autofocus placeholder="Kebutuhan">
                        </td>
                      </tr>
                      <tr>
                          <td><b> Satuan</b></td>
                          <td>
                                <select name="satuan" id="satuan"  class="form-control" required>
                                    <option value="">-- pilih Satuan --</option>
                                    <option value="Kilogram">Kilogram</option>
                                    <option value="m2">m2</option>
                                    <option value="Gram">Gram</option>
                                    <option value="Amp">Amp</option>
                                    <option value="Tablet">Tablet</option>
                                    <option value="mg">mg</option>
                                    <option value="inj">inj</option>
                                    <option value="Unit">Unit</option>
                                    <option value="Buah">Buah</option>
                                    <option value="Paket">Paket</option>
                                    <option value="Rim">Rim</option>
                                    <option value="Box">Box</option>
                                    <option value="Dosin">Dosin</option>
                                    <option value="Lembar">Lembar</option>
                                    <option value="Botol">Botol</option>
                                    <option value="Pcs">Pcs</option>
                                    <option value="Liter">Liter</option>
                                    <option value="ml">ml</option>
                                </select>
                          </td>
                      </tr>
                      <tr>
                          <td><b>Harga Satuan</b></td>
                          <td>
                              <input type="text" name="harga" id="harga" class="form-control" placeholder="Harga Satuan" required>
                          </td>
                      </tr>

                      <tr>
                          <td>Catatan</td>
                          <td><textarea name="catatan" id="catatan" class="form-control col-md"></textarea></td>
                      </tr>
                      
                    </table>
                      
                  
                  <div class="form-group row mb-0">
                      <label for="simpan" class="col-md-4 col-form-label"></label>
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
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

    
        <script>
            $('#namaBarang').selectize({
                create: true,
                sortField: 'text'
            });

            $('#namaBarang').change(function(){
                var id = $('#namaBarang').val();
                
                $.get("{{ url('loadBarang')}}/"+id, function(data) {
                    $('#spesifikasi').val(data.spesifikasi);
                    $('#nama_barang').val(data.nama);
                    $('#satuan').html(data.satuanBarang);
                    $('#satuan').selectize({
                        create: false,
                        sortField: 'text'
                    });
                });

            });

            
        </script>

@endsection

@section('script')
    <script>
        $(function () {
          $('#itemBarang').DataTable({"pageLength": 10});
        });
    </script>
@endsection