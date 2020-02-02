@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Input Unit Kerja</li>
          </ol>
@stop
@section('content')
	<div class="box box-solid box-warning">
		<div class="box-header">
			<h4>Form Input Unit Kerja</h4>
		</div>
		
		<div class="box-body">
			<form id="formProdi" class="form-horizontal" role="form" method="POST" action="{{ url('/unitKerja/tambah') }}">
	          @csrf

	          <div class="">
	              <label class="col-md-4 control-label">Nama Unit Kerja</label>
	              <div class="col-md-6">
	                  <input type="text" class="form-control" name="nama_unit_kerja" required>
	                  <small class="help-block"></small>
	              </div>
	          </div>

	          <div class="">
	              <label class="col-md-4 control-label">No. Telp </label>
	              <div class="col-md-6">
	                  <input type="number" class="form-control" name="no_telp" required>
	                  <small class="help-block"></small>
	              </div>
	          </div>

	          <div class="">
	              <label class="col-md-4 control-label">E-Mail</label>
	              <div class="col-md-6 has-error">
	                  <input type="email" class="form-control" name="email_unit_kerja" required>
	                  
	                  <small class="help-block"></small>
	              </div>
	          </div>

	          <div class="">
	              <label class="col-md-4 control-label">Kode Agenda Satker</label>
	              <div class="col-md-6 has-error">
	                  <input type="text" class="form-control" name="kode_agenda_satker" required>
	                  
	                  <small class="help-block"></small>
	              </div>
	          </div>

	          <div class="">
	              <div class="col-md-6 col-md-offset-4">
	                  <button type="submit" class="btn btn-primary" id="button-reg">
	                      Simpan
	                  </button>
	              </div>
	          </div>
	      </form>
		</div>
	</div>
	 

@endsection

@section('script')



@endsection

