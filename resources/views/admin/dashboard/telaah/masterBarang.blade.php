@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Master Barang</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Master Barang</li>
          </ol>
@stop
@section('content')
	<div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                  	<h3 class="box-title">
                  		Data Master Barang<br>
                  	</h3>

                </div><!-- /.box-header -->
                
                <div class="box-body">
                	<table id="dataTtd" class="table table-bordered">
                		<thead>
                			<tr>
                				<th width="5%">No</th>
                				<th width="25%">Jenis</th>
                				<th width="15%">Nama Barang</th>
                				<th width="25%">Spesifikasi</th>
                				<th width="5%">Satuan</th>
                				<th width="15%">Action</th>
                			</tr>
                		</thead>

                		<tbody>
                			<?php $urut=1; ?>
                			@foreach($data as $ttd) 
                			<tr>
                				<td>{{$urut++}}</td>
                				<td>{{getJenis($ttd->kode_jenis_barang)}}</td>
                				<td>{{$ttd->nama_barang}}</td>
                				<td>{{$ttd->spesifikasi}}</td>
                				<td>{{$ttd->satuan}}</td>
                				<td>
                					<div class="btn-group">
                						<a data-toggle="modal" data-target="#edit{{$ttd->id_master_barang}}" class="btn btn-primary btn" title="Edit Data"><i class="fa fa-edit"></i></a>
                						<a data-toggle="modal" data-target="#hapus{{$ttd->id_master_barang}}" class="btn btn-danger btn" title="Hapus Data"><i class="fa fa-trash"></i></a>
                					</div>
                					
                          <!-- Modal Edit -->
                        <div class="modal modal-default fade" id="edit{{$ttd->id_master_barang}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">Edit Data Referensi Tanda Tangan</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="box-body">
                                    <form  role="form" method="POST" action="{{ url('masterBarang/edit/'.$ttd->id_master_barang.'') }}">
                                      @csrf
                                      <table class="" width="100%">
                                          <tr>
                                            <td width="30%"><b>Jenis Barang</b></td>
                                            <td width="70%">
                                              <select name="kode_jenis_barang" id="kode_jenis_barang"  class="form-control">
                                                <option value="{{$ttd->kode_jenis_barang}}">{{getJenis($ttd->kode_jenis_barang)}}</option>
                                                <option value="">-- pilih jenis barang --</option>
                                                <option value="5201">Barang Cetakan</option>
                                                <option value="5202">Barang ATK</option>
                                                <option value="5203">Barang Rumah Tangga</option>
                                                <option value="5204">Perbekalan Obat</option>
                                                <option value="5205">AMHP/BMHP</option>
                                                <option value="5206">Belanja Operasional</option>
                                                <option value="5207">Jasa</option>
                                                <option value="5208">Bahan Makanan</option>
                                                <option value="5301">Investasi Alat Kesehatan</option>
                                                <option value="5302">Investasi Alat Non Kesehatan</option>
                                                <option value="5303">Investasi Perangkat Pengolah Data</option>
                                              </select>
                                              <small class="help-block"></small>
                                              @if ($errors->has('kode_jenis_barang'))
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $errors->first('kode_jenis_barang') }}</strong>
                                                  </span>
                                              @endif
                                            </td>
                                          </tr>

                                          <script>
                                              $('#kode_jenis_barang').selectize({
                                              create: false,
                                              sortField: 'text'
                                              });
                                          </script>

                                          <tr>
                                            <td><b>Nama Barang</b></td>
                                            <td>
                                              <input id="nama_barang" type="text" class="form-control {{ $errors->has('nama_barang') ? ' is-invalid' : '' }}" name="nama_barang" value="{{ $ttd->nama_barang }}" required autofocus placeholder="Nama Barang">
                                              <small class="help-block"></small>
                                              @if ($errors->has('nama_barang'))
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $errors->first('nama_barang') }}</strong>
                                                  </span>
                                              @endif
                                            </td>
                                          </tr>
                                          <tr>
                                            <td><b>Spesifikasi</b></td>
                                            <td>
                                              <textarea name="spesifikasi" id="spesifikasi" class="form-control" cols="30" rows="10">{{$ttd->spesifikasi}}</textarea>
                                              <small class="help-block"></small>
                                              
                                            </td>
                                          </tr>
                                          
                                          <tr>
                                              <td width="30%"><b>Satuan</b></td>
                                              <td width="70%">
                                                <select name="satuan" id="satuan"  class="form-control">
                                                  <option value="{{$ttd->satuan}}">{{$ttd->satuan}}</option>
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
                                                <small class="help-block"></small>
                                                @if ($errors->has('satuan'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('satuan') }}</strong>
                                                    </span>
                                                @endif
                                              </td>
                                            </tr>
                                        </table>
                                        
                                        <script>
                                            $('#satuan').selectize({
                                            create: false,
                                            sortField: 'text'
                                            });
                                        </script>
                                      
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
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>

                          <!--
                              DIALOG UNTUK HAPUS TTD
                          -->

                            <!-- modal untuk hapus -->
                            <div class="modal modal-warning fade" id="hapus{{$ttd->id_master_barang}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">HAPUS DATA MASTER BARANG</h4>
                                  </div>
                                  <div class="modal-body" style="color:#ffffff;">
                                    <form method="POST" action="{{ url('/masterBarang/hapus/'.$ttd->id_master_barang.'') }}">
                                      @csrf
                                      <input type="hidden" name="id" id="id" value="{{ $ttd->id_master_barang }}">
                                        <p>Apakah anda yakin akan <b>MENGHAPUS</b> Master barang <b>{{$ttd->nama_barang}}</b> ini?</p>
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
                			@endforeach
                		</tbody>
                	</table>
               	</div>
            </div>
        </div>
    </div>
  
@endsection

@section('script')
	
    
    <script>
      $(function () {

        $('#dataTtd').DataTable({
          "pageLength": 50
          });

      });

    </script>

@endsection