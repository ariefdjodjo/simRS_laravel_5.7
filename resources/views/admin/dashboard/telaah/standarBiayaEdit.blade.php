@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Standart Biaya</li>
          </ol>
@stop
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Referensi Standart Biaya Tahun {{$tahun}}</h3>
                </div><!-- /.box-header -->
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="box-body">
                    <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('standarBiaya/prosesEdit/'.$tahun.'') }}">
                        @csrf
                        <table width="100%" style="padding:3px">
                            <tr>
                                <td width="30%" style="text-align:right; padding:10px">Nama Barang</td>
                                <td width="70%">
                                    <select name="nama_barang" id="nama_barang" class="">
                                        <option value="{{$standar->id_master_barang}}">{{$standar->nama_barang}}</option>
                                        <option value="">-- Isikan Barang --</option>
                                        @foreach($barang as $data)
                                            <option value="{{$data->id_master_barang}}">{{$data->nama_barang}}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        $('#nama_barang').selectize({
                                        create: true,
                                        sortField: 'text'
                                        });
                                    </script>
                                    <input type="hidden" name="id_sb" id="id_sb" value="{{$standar->id_kebutuhan_barang}}">
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:right; padding:10px">Persediaan</td>
                                <td><input type="text" name="persediaan" id="persediaan" value="{{$standar->barang_tersedia}}" class="form-control"></td>
                            </tr>

                            <tr>
                                <td style="text-align:right; padding:10px">Kebutuhan</td>
                                <td><input type="text" name="kebutuhan" id="kebutuhan" value="{{$standar->kebutuhan}}"  class="form-control"></td>
                            </tr>

                            <tr>
                                <td style="text-align:right; padding:10px">Harga Satuan</td>
                                <td><input type="text" name="harga" id="harga" value="{{$standar->harga_satuan}}"  class="form-control"></td>
                            </tr>

                            <tr>
                                <td style="text-align:right; padding:10px">Dasar penentuan harga</td>
                                <td><input type="text" name="dasar" id="harga" value="{{$standar->dasar_harga}}"  class="form-control"></td>
                            </tr>

                            <tr>
                                <td style="text-align:right; padding:10px" valign="top">Lampiran</td>
                                <td>
                                    <input id="file" class="btn btn-info" type="file" name="file" data-show-preview="true">
                                    <br><p>{{$standar->lampiran}}</p>
                                    <p id="loading"></p>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                                    <a href="{{url('standarBiaya/'.$tahun)}}" class="btn btn-danger">Batal</a>
                                </td>
                            </tr>
                        </table>
                    </form>
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