@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Administrator</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Profile User</li>
          </ol>
@stop
@section('content')
	<div class="box box-solid box-info" width="20%">
		<div class="box-header">
			<div class="box-tittle"><h4>PROFIL USER</h4></div>
		</div>
		<div class="box-body">
			
			<table class="table">
				<tr>
					<td width="20%">
						<img src="{{ URL::asset('admin/dist/img/user-160-nobody.jpg') }}" class="img-responsive img-thumbnail" alt="Responsive image">
					</td>
					<td width="80%">
						<h5><b>Data User</b></h5><hr>
						<dl class="dl-horizontal">
							<dt>Nama</dt>
							<dd>{{$user->name}}</dd>

							<dt>Alamat Email</dt>
							<dd>{{$user->email}}</dd>

							<dt>Username</dt>
							<dd>{{$user->username}}</dd>

							<dt>Level</dt>
							<dd>{{getLevel($user->level)}}</dd>

							<hr>
							<h5><b>Data Satuan Kerja</b></h5>
							<hr>
							<dt>Nama Unit Kerja</dt>
							<dd>{{$unit->nama_unit_kerja}}</dd>

							<dt>No. Telp</dt>
							<dd>{{$unit->no_telp}}</dd>

							<dt>E-mail Unit Kerja</dt>
							<dd>{{$unit->email_unit_kerja}}</dd>
							<hr>
						</dl>			
					</td>
				</tr>
			</table>
			
			
		</div>
	</div>
@endsection