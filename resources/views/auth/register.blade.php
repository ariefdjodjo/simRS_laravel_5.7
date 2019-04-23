@extends('admin.layout.master')

@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Register User</li>
          </ol>
@stop

@section('content')
<div class="box box-solid box-warning">
    <div class="box-header">
        <h4>Form Register User</h4>
    </div>
    
    <div class="box-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('user/regUser') }}">
            @csrf
            <div class="form-group">
                <label for="satker" class="col-md-4 control-label text-md-right">{{ __('Unit Kerja') }}</label>

                <div class="col-md-6">
                    <select id="id_unit_kerja" class="form-control" name="id_unit_kerja">
                        <option value="">-- Pilih Unit Kerja --</option>
                        @foreach($listMstUnitKerja as $list) 
                            <option value="{{ $list->id_unit_kerja}}">{{ $list->nama_unit_kerja }}</option>
                        @endforeach
                    </select>
                    <small class="help-block"></small>
                    @if ($errors->has('satker'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('satker') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <label for="name" class="col-md-4 control-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    <small class="help-block"></small>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="col-md-4 control-label">{{ __('Username') }}</label>

                <div class="col-md-6">
                    <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                    <small class="help-block"></small>
                    @if ($errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 control-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    <small class="help-block"></small>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 control-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    <small class="help-block"></small>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 control-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    <small class="help-block"></small>
                </div>
            </div>

            <div class="form-group row">
                <label for="username" class="col-md-4 control-label text-md-right">{{ __('Level') }}</label>

                <div class="col-md-6">
                    <select id="level" name="level" class="form-control">
                        <option value="">--Pilih Level User--</option>
                        @for($i=1; $i<6; $i++) 
                            <option value="{{ $i }}">{{ getLevel($i) }}</option>
                        @endfor
                        
                        
                    </select>
                    <small class="help-block"></small>

                    @if ($errors->has('level'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('level') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <label for="username" class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

    <script>
       $('#id_unit_kerja').selectize({
        create: false,
        sortField: 'text'
       });
    </script>

    <script>
       $('#level').selectize({
        create: false,
        sortField: 'text'
       });
    </script>
@endsection

