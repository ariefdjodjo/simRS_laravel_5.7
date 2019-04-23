@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Ttd Usulan</li>
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
    <p class="warning">Data Penandatangan Usulan dari Unit Kerja ini akan digunakan sebagai Referensi ketika membuat usulan. mohon pastikan data Kepala Unit Kerja telah di masukkan.</p>
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
              <form  role="form" method="POST" action="{{ url('ttdUsulan/tambah') }}">
                @csrf
                
                  <table class="" width="100%">
                    <tr>
                      <td width="30%"><b>Nama Kepala</b></td>
                      <td width="70%">
                        <input id="nama_kepala" type="text" class="form-control {{ $errors->has('nama_kepala') ? ' is-invalid' : '' }}" name="nama_kepala" value="{{ old('nama_kepala') }}" placeholder="Nama Kepala" required autofocus>
                        <input type="hidden" name="id_unit_kerja" value="{{Auth::user()->id_unit_kerja}}">
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
                        <input id="nip_kepala" type="text" class="form-control {{ $errors->has('nip_kepala') ? ' is-invalid' : '' }}" name="nip_kepala" value="{{ old('nip_kepala') }}" required autofocus placeholder="NIP Kepala">
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
              <form  role="form" method="POST" action="{{ url('ttdUsulan/tambah') }}">
                @csrf
                
                  <table class="" width="100%">
                    <tr>
                      <td width="30%"><b>Nama Kepala</b></td>
                      <td width="70%">
                    	<select >
                    		<option></option>
                    	</select>
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
                				<td>{{$ttd->nama_kepala}}</td>
                				<td>{{$ttd->nip_kepala}}</td>
                				<td>{{$ttd->jabatan}}</td>
                				<td>
                					@if($ttd->status == 1) 
                						<button class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                					@else
                						
                					@endif
                				</td>
                				<td>
                					<div class="btn-group">
                						<a data-toggle="modal" data-target="#edit{{$ttd->id_ttd_usulan}}" class="btn btn-primary btn" title="Edit Data"><i class="fa fa-edit"></i></a>
                						<a data-toggle="modal" data-target="#hapus{{$ttd->id_ttd_usulan}}" class="btn btn-danger btn" title="Hapus Data"><i class="fa fa-trash"></i></a>
                					</div>
                					
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