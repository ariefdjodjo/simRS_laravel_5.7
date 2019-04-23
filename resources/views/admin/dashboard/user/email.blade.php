@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Alamat Email</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Alamat Email untuk User Notifikasi</li>
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
						<dl class="dl-horizontal">
							<dt>Alamat Email</dt>
							<dd>
                                <form role="form" method="POST" action="{{ url('email/edit') }}">
                                    @csrf
                                    <input type="text" id="alamat_email" class="form-control"  name="alamat_email" value="{{$data->alamat_email}}" placeholder="Alamat Email" required>
                                    <input type="hidden" name="id" id="id" value="{{$data->id_email}}">
                                    <small class="help-block"></small>
                                    <button type="submit" class="btn btn-primary">
                                            {{ __('Simpan') }}
                                    </button>
                                </form>
                            </dd>
						</dl>			
					</td>
				</tr>
			</table>
			
			
		</div>
	</div>
@endsection