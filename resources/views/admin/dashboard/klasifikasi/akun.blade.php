@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Master Akun</li>
          </ol>
@stop
@section('content')
    <div class="box box-primary">
        <div class="box-header">
        <div class="btn-group">
            @foreach($data_tahun as $th)
                <a href="{{{URL::to('akun/'.$th->tahun)}}}" 
                    @if($tahun == $th->tahun)
                        class="btn btn-primary " 
                    @else 
                        class="btn btn-default " 
                    @endif
                    role="button">{{$th->tahun}}</a>
            @endforeach
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Master Akun Anggaran</h3>
                </div><!-- /.box-header -->
                
                <div class="box-body">
    @if($tahun == 0) 
        Pilih Tahun 
    @else
    <div style="padding:5px"><a href="" data-toggle="modal" data-target="#tambah" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Akun</a></div>
    
    <div class="modal modal-default fade" id="tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Akun Belanja</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                    <form  role="form" method="POST" action="{{ url('akun/addAkun') }}">
                        @csrf
                        <table class="table">
                            <tr>
                                <td width="30%">Tahun</td>
                                <td width="70%"><input type="hidden" id="tahun" name="tahun" placeholder="Tahun" value="{{$tahun}}">{{$tahun}}</td>
                            </tr>
                            <tr>
                                <td>Kode Akun</td>
                                <td><input style="width:100%" type="text" id="kode_akun" name="kode_akun" placeholder="Kode Akun" required></td>
                            </tr>
                            <tr>
                                <td>Uraian Akun</td>
                                <td><input style="width:100%" type="text" id="uraian_akun" name="uraian_akun" placeholder="Uraian Akun" required></td>
                            </tr>
                            <tr>
                                <td>Sumber Dana</td>
                                <td>
                                    <select style="width:100%" id="sumber_dana" name="sumber_dana" placeholder="Pilih Sumber Dana" required>
                                        <option></option>
                                        <option value="APBN">APBN</option>
                                        <option value="PNBP">PNBP</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        
                        <div class="form-group row mb-0">
                            <label for="username" class="col-md-4 col-form-label"></label>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
        <table id="dataAkun" class="table table-bordered">
        <thead>
            <tr>
            <th width="5%">No</th>
            <th width="10%">Kode Akun</th>
            <th width="40%">Uraian Akun</th>
            <th width="15%">Sumber Dana</th>
            <th width="20%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $urut=1; ?>
            @foreach($data as $akun)
                <tr>
                    <td>{{{$urut++}}}</td>
                    <td>{{{$akun->kode_akun}}}</td>
                    <td>{{{$akun->uraian_akun}}}</td>
                    <td>{{{$akun->sumber_dana}}}</td>
                    <td>
                    <div class="btn-group">
                        <a href="" data-toggle="modal" data-target="#edit{{$akun->id_akun}}" class="btn btn-info btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="" data-toggle="modal" data-target="#hapus{{$akun->id_akun}}" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                    </div>
                    <!-- edit -->
                        <div class="modal modal-default fade" id="edit{{$akun->id_akun}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Edit Akin Belanja</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="box-body">
                                        <form  role="form" method="POST" action="{{ url('akun/editAkun') }}">
                                            @csrf
                                            <table class="table">
                                                <tr>
                                                    <td width="30%">Tahun</td>
                                                    <td width="70%">
                                                        <input type="hidden" id="id_akun" name="id_akun" placeholder="Akun" value="{{$akun->id_akun}}">
                                                        <input type="hidden" id="tahun" name="tahun" placeholder="Tahun" value="{{$tahun}}">
                                                        {{$tahun}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kode Akun</td>
                                                    <td><input style="width:100%" type="text" id="kode_akun" name="kode_akun" value="{{$akun->kode_akun}}" placeholder="Kode Akun" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Uraian Akun</td>
                                                    <td><input style="width:100%" type="text" id="uraian_akun" name="uraian_akun" value="{{$akun->uraian_akun}}" placeholder="Uraian Akun" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Sumber Dana</td>
                                                    <td>
                                                        <select style="width:100%" id="sumber_dana" name="sumber_dana" placeholder="Pilih Sumber Dana" required>
                                                            <option value="{{$akun->sumber_dana}}">{{$akun->sumber_dana}}</option>
                                                            <option value="APBN">APBN</option>
                                                            <option value="PNBP">PNBP</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                            
                                            <div class="form-group row mb-0">
                                                <label for="username" class="col-md-4 col-form-label"></label>
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                                        {{ __('Simpan') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal modal-warning fade" id="hapus{{$akun->id_akun}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title">HAPUS DATA AKUN</h4>
                                    </div>
                                    <div class="modal-body" style="color:#ffffff;">
                                      <form method="POST" action="{{ url('akun/hapusAkun/'.$akun->id_akun.'/'.$tahun.'') }}">
                                        @csrf
                                            <input type="hidden" id="tahun" name="tahun" placeholder="Tahun" value="{{$tahun}}">
                                          <p>Apakah anda yakin akan <b>MENGHAPUS</b> Akun {{$akun->kode_akun}} - {{$akun->uraian_akun}}?</p>
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
  
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>  
    @endif
                </div>
            </div>
        </div>
    </div>    
@endsection

@section('script')
	
    
    <script>
      $(function () {

        $('#dataAkun').DataTable({"pageLength": 10});

      });

    </script>

@endsection