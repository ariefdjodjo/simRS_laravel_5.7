@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Master PPK</li>
          </ol>
@stop
@section('content')

	<div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                	<a data-toggle="modal" data-target="#tambahPpk" class="btn btn-success"><i class="fa fa-plus"></i> Tambah PPK</a>
                	<hr>
                  	<h3 class="box-title">Data Master PPK</h3>
                </div><!-- /.box-header -->
                
                <!-- MODAL TAMBAH PPK -->
                <div class="modal modal-default fade" id="tambahPpk">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Tambah Data PPK</h4>
                      </div>
                      <div class="modal-body">
                        <div class="box-body">
                          <form  role="form" method="POST" action="{{ url('mstPpk/tambah') }}">
                            @csrf
                            
                              <table class="" width="100%">
                                <tr>
                                  <td width="30%"><b>Nama PPK</b></td>
                                  <td width="70%">
                                    <input id="nama_ppk" type="text" class="form-control {{ $errors->has('nama_ppk') ? ' is-invalid' : '' }}" name="nama_ppk" value="{{ old('nama_ppk') }}" required autofocus>
                                    <small class="help-block"></small>
                                    @if ($errors->has('satker'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('satker') }}</strong>
                                        </span>
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td><b>NIP</b></td>
                                  <td>
                                    <input id="nip_ppk" type="text" class="form-control {{ $errors->has('nip_ppk') ? ' is-invalid' : '' }}" name="nip_ppk" value="{{ old('nip_ppk') }}" required autofocus>
                                    <small class="help-block"></small>
                                    @if ($errors->has('nip_ppk'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nip_ppk') }}</strong>
                                        </span>
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td><b>Jabatan PPK</b></td>
                                  <td>
                                    <input id="jabatan_ppk" type="text" class="form-control {{ $errors->has('jabatan_ppk') ? ' is-invalid' : '' }}" name="jabatan_ppk" value="{{ old('jabatan_ppk') }}" required autofocus>
                                    <small class="help-block"></small>
                                    @if ($errors->has('jabatan_ppk'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('jabatan_ppk') }}</strong>
                                        </span>
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td><b>Dasar SK</b></td>
                                  <td>
                                    <input id="dasar_ppk" type="text" class="form-control{{ $errors->has('dasar_ppk') ? ' is-invalid' : '' }}" name="dasar_ppk" value="{{ old('dasar_ppk') }}" required>
                                    <small class="help-block"></small>

                                    @if ($errors->has('dasar_ppk'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dasar_ppk') }}</strong>
                                        </span>
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td><b>Tanggal Awal</b></td>
                                  <td>
                                    <input id="awal_berlaku" type="date" class="form-control {{ $errors->has('awal_berlaku') ? ' is-invalid' : '' }}" name="awal_berlaku" value="{{ old('awal_berlaku') }}" required autofocus>
                                    <small class="help-block"></small>

                                    @if ($errors->has('awal_berlaku'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('awal_berlaku') }}</strong>
                                        </span>
                                    @endif
                                  </td>
                                </tr>
                                <tr>
                                  <td><b>Tanggal Akhir</b></td>
                                  <td>
                                    <input id="akhir_berlaku" type="date" class="form-control {{ $errors->has('akhir_berlaku') ? ' is-invalid' : '' }}" name="akhir_berlaku" value="{{ old('akhir_berlaku') }}" required autofocus>
                                    <small class="help-block"></small>

                                    @if ($errors->has('akhir_berlaku'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('akhir_berlaku') }}</strong>
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


                <div class="box-body">
                <table id="dataPpk" class="table table-bordered table-hover">
                	<thead>
                		<tr>
                			<th>No</th>
                			<th>Nama</th>
                			<th>NIP</th>
                			<th>Jabatan</th>
                			<th>#</th>
                		</tr>
                	</thead>
                	<tbody>
                		<?php $no = 1; ?>
                		@foreach($data as $ppk)
                		<tr>
                			<td>{{ $no++ }}</td>
                			<td>{{ $ppk->nama_ppk }}</td>
                			<td>{{ $ppk->nip_ppk }}</td>
                			<td>{{ $ppk->jabatan_ppk }}</td>
                			<td>
                                @if($ppk->status_ppk == 1)
                                    <a href="" class="btn btn-success btn" title="Status PPK" data-toggle="modal" data-target="#status{{$ppk->id_ppk}}"><i class="fa fa-check"></i></a>
                                @else 
                                    <a href="" class="btn btn-danger btn" title="Status PPK" data-toggle="modal" data-target="#status{{$ppk->id_ppk}}"><i class="fa fa-remove"></i></a>
                                @endif
                                
                                <!-- Modal untuk ganti status -->

                            <div class="modal modal-warning fade" id="status{{$ppk->id_ppk}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Status User Aktif/Non-Aktif</h4>
                                  </div>
                                  <div class="modal-body" style="color:#ffffff;">
                                    <form method="POST" action="{{ url('/mstPpk/setStatus/'.$ppk->id_ppk.'') }}">
                                      @csrf
                                      <input type="hidden" name="id" id="id" value="{{ $ppk->id_ppk }}">
                                      @if($ppk->status_ppk == 1) 
                                        <p>Apakah anda akan me non-aktifkan Default PPK ini?</p>
                                        <input type="hidden" name="status" id="status" value="0">
                                      @else
                                        <p>Apakah anda akan mengaktifkan PPK ini sebagai Default?</p>
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

                				<div class="btn-group">
                					
                                    <a data-toggle="modal" data-target="#detail{{$ppk->id_ppk}}" class="btn btn-info btn" title="Lihat Detail Data"><i class="fa fa-list"></i></a>
                					<a data-toggle="modal" data-target="#edit{{$ppk->id_ppk}}" class="btn btn-primary btn" title="Edit Data"><i class="fa fa-edit"></i></a>
                					<a data-toggle="modal" data-target="#hapus{{$ppk->id_ppk}}" class="btn btn-danger btn" title="Hapus Data"><i class="fa fa-trash"></i></a>
                				</div>
                				
                            <!--
                              DIALOG UNTUK MELIHAT DETAIL
                            -->

                            <!-- modal untuk detail -->
                            <div class="modal modal-default fade" id="detail{{$ppk->id_ppk}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Detail PPK</h4>
                                  </div>
                                  <div class="modal-body">
                                      <dl class="dl-horizontal">
                                        <dt>ID</dt>
                                        <dd>{{ $ppk->id_ppk }}</dd>

                                        <dt>Nama PPK</dt>
                                        <dd>{{ $ppk->nama_ppk }}</dd>

                                        <dt>NIP </dt>
                                        <dd>{{ $ppk->nip_ppk }}</dd>

                                        <dt>Dasar SK</dt>
                                        <dd>{{ $ppk->dasar_ppk }}</dd>

                                        <dt>Awal</dt>
                                        <dd>{{ getTfi($ppk->awal_berlaku) }}</dd>

                                        <dt>Akhir</dt>
                                        <dd>{{ getTfi($ppk->akhir_berlaku) }}</dd>
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
                            
                            <div class="modal modal-default fade" id="edit{{$ppk->id_ppk}}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Edit Data PPK</h4>
                                      </div>
                                      <div class="modal-body">
                                        <div class="box-body">
                                          <form  role="form" method="POST" action="{{ url('mstPpk/edit/'.$ppk->id_ppk.'') }}">
                                            @csrf
                                            
                                              <table class="" width="100%">
                                                <tr>
                                                  <td width="30%"><b>Nama PPK</b></td>
                                                  <td width="70%">
                                                    <input id="nama_ppk" type="text" class="form-control {{ $errors->has('nama_ppk') ? ' is-invalid' : '' }}" name="nama_ppk" value="{{ $ppk->nama_ppk }}" required autofocus>
                                                    <small class="help-block"></small>
                                                    @if ($errors->has('satker'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('satker') }}</strong>
                                                        </span>
                                                    @endif
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td><b>NIP</b></td>
                                                  <td>
                                                    <input id="nip_ppk" type="text" class="form-control {{ $errors->has('nip_ppk') ? ' is-invalid' : '' }}" name="nip_ppk" value="{{ $ppk->nip_ppk }}" required autofocus>
                                                    <small class="help-block"></small>
                                                    @if ($errors->has('nip_ppk'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('nip_ppk') }}</strong>
                                                        </span>
                                                    @endif
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td><b>Jabatan PPK</b></td>
                                                  <td>
                                                    <input id="jabatan_ppk" type="text" class="form-control {{ $errors->has('jabatan_ppk') ? ' is-invalid' : '' }}" name="jabatan_ppk" value="{{ $ppk->jabatan_ppk }}" required autofocus>
                                                    <small class="help-block"></small>
                                                    @if ($errors->has('jabatan_ppk'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('jabatan_ppk') }}</strong>
                                                        </span>
                                                    @endif
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td><b>Dasar SK</b></td>
                                                  <td>
                                                    <input id="dasar_ppk" type="text" class="form-control{{ $errors->has('dasar_ppk') ? ' is-invalid' : '' }}" name="dasar_ppk" value="{{ $ppk->dasar_ppk }}" required>
                                                    <small class="help-block"></small>

                                                    @if ($errors->has('dasar_ppk'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('dasar_ppk') }}</strong>
                                                        </span>
                                                    @endif
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td><b>Tanggal Awal</b></td>
                                                  <td>
                                                    <input id="awal_berlaku" type="date" class="form-control {{ $errors->has('awal_berlaku') ? ' is-invalid' : '' }}" name="awal_berlaku" value="{{ $ppk->awal_berlaku }}" required autofocus>
                                                    <small class="help-block"></small>

                                                    @if ($errors->has('awal_berlaku'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('awal_berlaku') }}</strong>
                                                        </span>
                                                    @endif
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td><b>Tanggal Akhir</b></td>
                                                  <td>
                                                    <input id="akhir_berlaku" type="date" class="form-control {{ $errors->has('akhir_berlaku') ? ' is-invalid' : '' }}" name="akhir_berlaku" value="{{ $ppk->akhir_berlaku }}" required autofocus>
                                                    <small class="help-block"></small>

                                                    @if ($errors->has('akhir_berlaku'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('akhir_berlaku') }}</strong>
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
                              DIALOG UNTUK HAPUS PPK
                          -->

                            <!-- modal untuk hapus -->
                            <div class="modal modal-warning fade" id="hapus{{$ppk->id_ppk}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">HAPUS DATA PPK</h4>
                                  </div>
                                  <div class="modal-body" style="color:#ffffff;">
                                    <form method="POST" action="{{ url('/mstPpk/hapus/'.$ppk->id_ppk.'') }}">
                                      @csrf
                                      <input type="hidden" name="id" id="id" value="{{ $ppk->id_ppk }}">
                                        <p>Apakah anda yakin akan <b>MENGHAPUS</b> ppk ini?</p>
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

        $('#dataPpk').DataTable({"pageLength": 10});

      });

    </script>

@endsection