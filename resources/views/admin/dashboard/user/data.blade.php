@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data User</li>
          </ol>
@stop
@section('content')
  <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Unit Kerja</h3>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                  <table id="dataUser" class="table table-bordered">
                    <thead>
                      <tr>
                        <th width="5%">No</th>
                        <th width="20%">Nama User</th>
                        <th width="20%">Username</th>
                        <th width="25%">Email</th>
                        <th width="5%">Status</th>
                        <th width="10%">Level</th>
                        <th width="20%">Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php 
                        $urut = 1;

                        foreach($data as $user):
                      ?>
                      <tr>
                        <td>{{ $urut++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td align="center">
                          
                            @if($user->status == 0)
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#status{{$user->id}}">
                              <i class="fa fa-remove"></i>
                            @else 
                              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#status{{$user->id}}">
                              <i class="fa fa-check"></i>
                            @endif

                          </button>

                          <!--
                              DIALOG UNTUK UBAH STATUS USER
                          -->

                            <!-- modal untuk status -->
                            <div class="modal modal-warning fade" id="status{{$user->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Status User Aktif/Non-Aktif</h4>
                                  </div>
                                  <div class="modal-body" style="color:#ffffff;">
                                    <form method="POST" action="{{ url('/user/setStatus/'.$user->id.'') }}">
                                      @csrf
                                      <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                      @if($user->status == 1) 
                                        <p>Apakah anda akan me non-aktifkan user ini?</p>
                                        <input type="hidden" name="status" id="status" value="0">
                                      @else
                                        <p>Apakah anda akan mengaktifkan user ini?</p>
                                        <input type="hidden" name="status" id="status" value="1">
                                      @endif

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
                        <td>{{ getLevel($user->level) }}</td>
                        <td>
                          <div class="btn-group">
                            <a data-toggle="modal" data-target="#detail{{$user->id}}" class="btn btn-info btn-sm" title="Detail"><i class="fa fa-list"></i></a>
                            <a data-toggle="modal" data-target="#edit{{$user->id}}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                            <a data-toggle="modal" data-target="#hapus{{$user->id}}" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                            <a data-toggle="modal" data-target="#ubahPassword{{$user->id}}" class="btn btn-warning btn-sm" title="Ubah Password"><i class="fa fa-key"></i></a>

                            <!--
                              DIALOG UNTUK MELIHAT DETAIL
                            -->

                            <!-- modal untuk detail -->
                            <div class="modal modal-default fade" id="detail{{$user->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Detail User</h4>
                                  </div>
                                  <div class="modal-body">
                                      <dl class="dl-horizontal">
                                        <dt>ID</dt>
                                        <dd>{{ $user->id }}</dd>

                                        <dt>Unit Kerja</dt>
                                        <dd>{{ $user->nama_unit_kerja }}</dd>

                                        <dt>Nama</dt>
                                        <dd>{{ $user->name }}</dd>

                                        <dt>Email</dt>
                                        <dd>{{ $user->email }}</dd>

                                        <dt>Username</dt>
                                        <dd>{{ $user->username }}</dd>

                                        <dt>Level</dt>
                                        <dd>{{ getLevel($user->level) }}</dd>
                                      </dl>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>

                            <!--
                              DIALOG UNTUK EDIT DATA
                            -->

                            <!-- modal untuk edit -->
                            <div class="modal modal-info fade" id="edit{{$user->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Detail User</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="box-body">
                                      <form  role="form" method="POST" action="{{ url('user/editUser/'.$user->id.'') }}">
                                        @csrf
                                        
                                          <table class="" width="100%">
                                            <tr>
                                              <td><label for="satker" class="control-label text-md-right">{{ __('Unit Kerja') }}</label></td>
                                              <td>
                                                <select id="id_unit_kerja{{$user->id}}" class="form-control" name="id_unit_kerja" style="width:100%">
                                                    <option value="{{$user->id_unit_kerja}}">{{$user->nama_unit_kerja}}</option>
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
                                              </td>
                                            </tr>
                                            <tr>
                                              <td><label for="name" class="col-md-4 control-label text-md-right">{{ __('Name') }}</label></td>
                                              <td>
                                                <input id="name" type="text" style="width:100%" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>
                                                <small class="help-block"></small>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                              </td>
                                            </tr>
                                            <tr>
                                              <td><label for="username" class="col-md-4 control-label">{{ __('Username') }}</label></td>
                                              <td>
                                                <input id="username" style="width:100%" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $user->username }}" required autofocus>
                                                <small class="help-block"></small>
                                                @if ($errors->has('username'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('username') }}</strong>
                                                    </span>
                                                @endif
                                              </td>
                                            </tr>
                                            <tr>
                                              <td><label for="email" class="col-md-4 control-label text-md-right">{{ __('E-Mail Address') }}</label></td>
                                              <td>
                                                <input id="email" type="email" style="width:100%" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>
                                                <small class="help-block"></small>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                              </td>
                                            </tr>
                                            <tr>
                                              <td><label for="username" class="col-md-4 control-label text-md-right">{{ __('Level') }}</label></td>
                                              <td>
                                                <select id="level{{$user->id}}" name="level" class="form-control" style="width:100%">
                                                    <option value="{{ $user->level }}">{{getLevel($user->level)}}</option>
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
                                              </td>
                                            </tr>
                                          </table>
                                            
                                        
                                        <div class="form-group row mb-0">
                                            <label for="username" class="col-md-4 col-form-label text-md-right"></label>
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Simpan') }}
                                                </button>
                                            </div>
                                        </div>
                                      </form>

                                      <script>
                                         $('#id_unit_kerja{{$user->id}}').selectize({
                                          create: false,
                                          sortField: 'text'
                                         });
                                      </script>

                                      <script>
                                         $('#level{{$user->id}}').selectize({
                                          create: false,
                                          sortField: 'text'
                                         });
                                      </script>

                                    </div>
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>

                            <!--
                              DIALOG UNTUK HAPUS USER
                          -->

                            <!-- modal untuk hapus -->
                            <div class="modal modal-warning fade" id="hapus{{$user->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">HAPUS DATA USER</h4>
                                  </div>
                                  <div class="modal-body" style="color:#ffffff;">
                                    <form method="POST" action="{{ url('/user/delete/'.$user->id.'') }}">
                                      @csrf
                                      <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                        <p>Apakah anda yakin akan <b>MENGHAPUS</b> user ini?</p>
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


                            <!--
                              DIALOG UNTUK EDIT DATA
                            -->

                            <!-- modal untuk edit -->
                            <div class="modal modal-info fade" id="ubahPassword{{$user->id}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Detail User</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="box-body">
                                      <form  role="form" method="POST" action="{{ url('user/ubahPassword/'.$user->id.'') }}">
                                        @csrf
                                        
                                          <table class="" width="100%">
                                            <tr>
                                              <td><label for="password" class="col-md-4 control-label text-md-right">{{ __('Password_Baru') }}</label></td>
                                              <td>
                                                <input id="password" type="password" style="width:100%" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="" required>
                                                <small class="help-block"></small>

                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                              </td>
                                            </tr>
                                          </table>
                                            
                                        
                                        <div class="form-group row mb-0">
                                            <label for="username" class="col-md-4 col-form-label text-md-right"></label>
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


                          </div>
                        </td>
                      </tr>
                    <?php endforeach ?>
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

        $('#dataUser').DataTable({"pageLength": 10});

      });

    </script>

@endsection