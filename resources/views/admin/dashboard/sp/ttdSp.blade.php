@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>SPP</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Tanda Tangan SPP</li>
          </ol>
@stop
@section('content')

<div class="box box-solid box-warning">
  <div class="box-header with-border">
    <h1 class="box-title"><i class="fa fa-warning"></i> Penting</h1>
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
    <p class="warning">Data Penandatangan SPP ini akan digunakan sebagai Referensi ketika membuat SPP. mohon pastikan data Kepala Unit Kerja Penerbit SPP telah di masukkan.</p>
  </div><!-- /.box-body -->
</div><!-- /.box -->
	<div>
		<a data-toggle="modal" data-target="#tambahTtd"  class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
		<a data-toggle="modal" data-target="#setDefault"  class="btn btn-primary"><i class="fa fa-pencil"></i> Set Default Penandatangan</a>
	</div>

	<!-- Modal Tambah -->
	<div class="modal modal-default fade" id="tambahTtd">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah Data Referensi Tanda Tangan</h4>
          </div>
          <div class="modal-body">
            <div class="box-body">
              <form  role="form" method="POST" action="{{ url('ttdSp/tambah') }}">
                @csrf
                
                  <table class="" width="100%">
                    <tr>
                      <td width="30%"><b>Nama Kepala</b></td>
                      <td width="70%">
                        <input id="nama_penandatangan" type="text" class="form-control {{ $errors->has('nama_penandatangan') ? ' is-invalid' : '' }}" name="nama_penandatangan" value="{{ old('nama_penandatangan') }}" placeholder="Nama Penandatangan" required autofocus>
                        <small class="help-block"></small>
                        @if ($errors->has('nama_penandatangan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nama_penandatangan') }}</strong>
                            </span>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td><b>NIP</b></td>
                      <td>
                        <input id="nip_penandatangan" type="text" class="form-control {{ $errors->has('nip_penandatangan') ? ' is-invalid' : '' }}" name="nip_penandatangan" value="{{ old('nip_penandatangan') }}" required autofocus placeholder="NIP Penandatangan">
                        <small class="help-block"></small>
                        @if ($errors->has('nip_penandatangan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nip_penandatangan') }}</strong>
                            </span>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td><b>Jabatan</b></td>
                      <td>
                        <input id="jabatan" type="text" class="form-control {{ $errors->has('jabatan') ? ' is-invalid' : '' }}" name="jabatan" value="{{ old('jabatan') }}" required autofocus placeholder="Jabatan Kepala">
                        <small class="help-block"></small>
                        @if ($errors->has('jabatan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('jabatan') }}</strong>
                            </span>
                        @endif
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
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    
      <!-- Modal Set Default TTD -->
	<div class="modal modal-default fade" id="setDefault">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Set Data Referensi Tanda Tangan</h4>
          </div>
          <div class="modal-body">
            <div class="box-body">
              <form  role="form" method="POST" action="{{ url('ttdSp/setDefault') }}">
                @csrf
                
                  <table class="" width="100%">
                    <tr>
                      <td width="30%"><b>Nama Penandatangan</b></td>
                      <td width="70%">
                    	   <select id="id_ttd_sp" class="form-control" name="id_ttd_sp" style="width:100%">
                              <option value=""> -- Pilih Penandatangan --</option>
                              @foreach($data as $list) 
                                  <option value="{{ $list->id_ttd_sp}}">{{ $list->nama_penandatangan }} - {{ $list->jabatan }}</option>
                              @endforeach
                          </select>
                          <small class="help-block"></small>
                          <script>
                               $('#id_ttd_sp').selectize({
                                create: false,
                                sortField: 'text'
                               });
                          </script>
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
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

	<br>

	<div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                  	<h3 class="box-title">
                  		Data Referensi Tanda Tangan Kepala Unit Kerja<br>
                  	</h3>

                </div><!-- /.box-header -->
                
                <div class="box-body">
                	<table id="dataTtd" class="table table-bordered">
                		<thead>
                			<tr>
                				<th width="5%">No</th>
                				<th width="25%">Nama Kepala</th>
                				<th width="15%">NIP</th>
                				<th width="25%">Jabatan</th>
                				<th width="5%">Default</th>
                				<th width="15%">Action</th>
                			</tr>
                		</thead>

                		<tbody>
                			<?php $urut=1; ?>
                			@foreach($data as $ttd) 
                			<tr>
                				<td>{{$urut++}}</td>
                				<td>{{$ttd->nama_penandatangan}}</td>
                				<td>{{$ttd->nip_penandatangan}}</td>
                				<td>{{$ttd->jabatan}}</td>
                				<td>
                					@if($ttd->status == 1) 
                						<button class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                					@else
                						
                					@endif
                				</td>
                				<td>
                					<div class="btn-group">
                						<a data-toggle="modal" data-target="#edit{{$ttd->id_ttd_sp}}" class="btn btn-primary btn" title="Edit Data"><i class="fa fa-edit"></i></a>
                						<a data-toggle="modal" data-target="#hapus{{$ttd->id_ttd_sp}}" class="btn btn-danger btn" title="Hapus Data"><i class="fa fa-trash"></i></a>
                					</div>
                					
                          <!-- Modal Edit -->
                        <div class="modal modal-default fade" id="edit{{$ttd->id_ttd_sp}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">Edit Data Referensi Tanda Tangan</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="box-body">
                                    <form  role="form" method="POST" action="{{ url('ttdSp/edit/'.$ttd->id_ttd_sp.'') }}">
                                      @csrf
                                      
                                        <table class="" width="100%">
                                          <tr>
                                            <td width="30%"><b>Nama Kepala</b></td>
                                            <td width="70%">
                                              <input id="nama_kepala" type="text" class="form-control {{ $errors->has('nama_kepala') ? ' is-invalid' : '' }}" name="nama_kepala" value="{{ $ttd->nama_penandatangan }}" placeholder="Nama Kepala" required autofocus style="width:100%">
                                              <input type="hidden" name="id_unit_kerja" value="{{$ttd->id_ttd_sp}}">
                                              <small class="help-block"></small>
                                              @if ($errors->has('nama_kepala'))
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $errors->first('nama_kepala') }}</strong>
                                                  </span>
                                              @endif
                                            </td>
                                          </tr>
                                          <tr>
                                            <td><b>NIP</b></td>
                                            <td>
                                              <input id="nip_kepala" type="text" class="form-control {{ $errors->has('nip_kepala') ? ' is-invalid' : '' }}" name="nip_kepala" value="{{ $ttd->nip_penandatangan }}" required autofocus placeholder="NIP Kepala" style="width:100%">
                                              <small class="help-block"></small>
                                              @if ($errors->has('nip_kepala'))
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $errors->first('nip_kepala') }}</strong>
                                                  </span>
                                              @endif
                                            </td>
                                          </tr>
                                          <tr>
                                            <td><b>Jabatan</b></td>
                                            <td>
                                              <input id="jabatan" type="text" class="form-control {{ $errors->has('jabatan') ? ' is-invalid' : '' }}" name="jabatan" value="{{ $ttd->jabatan }}" required autofocus placeholder="Jabatan Kepala" style="width:100%">
                                              <small class="help-block"></small>
                                              @if ($errors->has('jabatan'))
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $errors->first('jabatan') }}</strong>
                                                  </span>
                                              @endif
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
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>

                          <!--
                              DIALOG UNTUK HAPUS TTD
                          -->

                            <!-- modal untuk hapus -->
                            <div class="modal modal-warning fade" id="hapus{{$ttd->id_ttd_sp}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">HAPUS DATA REFERENSI TANDA TANGAN</h4>
                                  </div>
                                  <div class="modal-body" style="color:#ffffff;">
                                    <form method="POST" action="{{ url('/ttdSp/hapus/'.$ttd->id_ttd_sp.'') }}">
                                      @csrf
                                      <input type="hidden" name="id" id="id" value="{{ $ttd->id_ttd_sp }}">
                                        <p>Apakah anda yakin akan <b>MENGHAPUS</b> referensi Tanda Tangan ini?</p>
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

        $('#dataTtd').DataTable({"pageLength": 10});

      });

    </script>

@endsection