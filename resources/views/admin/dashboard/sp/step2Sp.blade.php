@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Tambah Surat Persetujuan Anggaran (SP)</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Tambah SP</li>
  </ol>
@stop

@section('content')
    {{-- @if ($sp->status_sp == "Aktif")
        <h2>Forbidden Access</h2>
    @else --}}
    <div class="box box-primary">
        <div class="box-header">
            <ul id="progressbar" class="progressbar">
                    <li class="active" style="width: 20%;">Pilih Tahun Anggaran</li>
                    <li class="active" style="width: 20%;">Data SP Anggaran</li>
                    <li class="" style="width: 20%;">Data Item Barang</li>
                    <li class="" style="width: 20%;">Cetak dan Kirim</li>
                    <li style="width: 20%;">Selesai</li>            
            </ul>
        </div>
        <hr>
        <div class="box-body">
            <form class="form-horizontal" name="formsp" method="post" action="{{url('spp/simpanSp')}}" onsubmit="return validasi()">
                @csrf
                <div class="form-group">
                    <label for="satker" class="col-md-4 control-label text-md-right">Tahun</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="th" id="th" value="{{$tahun}}" disabled>
                        <input type="hidden" name="id" id="id" value="{{$id}}">
                        <input type="hidden" id="user" name="user" value="{{$user}}" size="40px">
                        <input type="hidden" id="tahun" name="tahun" value="{{$tahun}}" size="40px">
                        <small class="help-block"></small>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label text-md-right" for="telaah">Surat Telaah</label>
                    <div class="col-md-6">
                    <select id="telaah" name="telaah" class="form-control" required>
                        @if($id!=0)
                            <option value="{{@$sp->id_telaah}}" placeholder="-- Pilih Surat Telaah --">{{@$sp->telaah->no_telaah}} - Telaah {{$sp->telaah->perihal_usulan}}</option>
                        @else 
                            <option value="">-- Pilih Surat Telaah --</option>
                        @endif
                        
                        @foreach ($telaah as $data)
                            <option value="{{$data->id_telaah}}">{{$data->no_telaah}}</option>
                        @endforeach
    
                    </select>
                    <small class="help-block"></small>
                    </div>
                </div>
                
                <script>
                    $('#telaah').selectize({
                        create: false,
                        sortField: 'text'
                    });

                    $('#telaah').change(function(){
                        var id = $('#telaah').val();
                        
                        $.get("{{ url('loadUsulanTelaah')}}/"+id, function(data) {
                            $('#usulan_telaah').html(data);
                        });

                    });
                </script>

                <div id="usulan_telaah"></div>
            
                <div class="form-group">
                    <label class="col-md-4 control-label text-md-right">Nomor SP Anggaran</label>
                    <div class="col-md-6">    
                        <select id="nosp" name="nosp" placeholder="Nomor SP Anggaran" class="form-control" required>
                            @if($id!=0)
                                <option value="{{$sp->no_sp}}">{{$sp->no_sp}}</option>
                            @else 
                                <option value=""> -- Pilih -- </option>
                            @endif
                            <option value="KU.02.01/XI.3.1/">KU.02.01/XI.3.1/ : Belanja Pegawai </option>
                            <option value="KU.02.02/XI.3.1/">KU.02.02/XI.3.1/ : Belanja Barang </option>
                            <option value="KU.02.03/XI.3.1/">KU.02.03/XI.3.1/ : Belanja Investasi </option>
                        </select>
                        <small class="help-block"></small>

                        <script>
                            $('#nosp').selectize({
                                create: false,
                                sortField: 'text'
                            });
                        </script>
                    </div>
                </div>
          
                <div class="form-group">
                    <label class="col-md-4 control-label text-md-right" for="inputTgl">Tgl. SP </label>
                    <div class="col-md-3">
                    <input type="date" id="tglsp" class="form-control" name="tglsp" 
                        @if ($id!=0)
                            value="{{$sp->tgl_sp}}"
                        @endif
                    required>
                        {{-- <script>
                        $(function(){
                            $("#tglsp").datepicker({
                                format:'yyyy-mm-dd'
                            });
                        });
                        </script>   --}}
                        <small class="help-block"></small>               		 
                    </div>
                </div>
          
            <div class="form-group">
                    <label class="col-md-4 control-label text-md-right" for="halsp">Perihal SP</label>
                    <div class="col-md-6">
                        <textarea type="text" id="halsp" class="form-control" name="halsp" placeholder="Perihal SP" required>@if ($id!=0){{$sp->hal_sp}}@endif</textarea>
                        <small class="help-block"></small>
                    </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label text-md-right" for="idalokasi">Sub Alokasi</label>
                <div class="col-md-6">
                <select id="idalokasi" name="idalokasi" class="form-control" required>
                    @if($id!=0)
                        <option value="{{$sp->sA->id_sub_alokasi}}">{{$sp->sA->uraian_sub_alokasi}}</option>
                    @else 
                        <option value="">-- Pilih Sub Alokasi --</option>
                    @endif
                    
                    @foreach ($subAlokasi as $data)
                        <option value="{{$data->id_sub_alokasi}}">{{$data->uraian_sub_alokasi}} - {{$data->akun->sumber_dana}}</option>
                    @endforeach

                </select>
                <small class="help-block"></small>
                </div>
            </div>
          
            <script>
                $('#idalokasi').selectize({
                    create: false,
                    sortField: 'text'
                });
            </script>

            <div class="form-group">
                <label class="col-md-4 control-label text-md-right" for="idalokasi">Penandatangan SP</label>
                <div class="col-md-6">
                <select id="penandatangan" name="penandatangan" class="form-control" required>
                    @if($id!=0)
                        <option value="{{$sp->penandatangan->id_ttd_sp}}">{{$sp->penandatangan->nama_penandatangan}} - {{$sp->penandatangan->jabatan}}</option>
                    @else 
                        <option value="">-- Pilih Penandatangan SP --</option>
                    @endif
                    
                    @foreach ($ttdSP as $data)
                        <option value="{{$data->id_ttd_sp}}">{{$data->nama_penandatangan}} - {{$data->jabatan}}</option>
                    @endforeach

                </select>
                <small class="help-block"></small>
                </div>
            </div>

            <script>
                $('#penandatangan').selectize({
                    create: false,
                    sortField: 'text'
                });
            </script>
             
    <div class="form-group">
            <label class="col-md-4 control-label text-md-right" for="idalokasi"></label>
                    <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Simpan</button>
             </div>
          </div>
        </div>
        <div class="bg-orange color-palette" style="padding:2px 15px 2px 15px">
            <ul class="pager">
                <li class="previous success">
                    <a href="">&larr; KEMBALI STEP 1</a>
                </li>
                <li class="next">
                    @if ($id!=0)
                        <a href="{{url('spp/tambah/step3/'.$tahun.'/'.$sp->id_sp)}}"><i class="icon icon-ok"></i> LANJUT STEP 3 &rarr;</a>
                    @endif
                </li>
            </ul>
        </div>
        </form>
    </div>

    {{-- @endif --}}
@endsection