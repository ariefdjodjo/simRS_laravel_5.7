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
    <div class="box box-primary">
        <div class="box-header">
        <div class="btn-group">
            @foreach($th as $data)
                <a href="{{{URL::to('standarBiaya/'.$data->tahun)}}}" 
                    @if($tahun == $data->tahun)
                        class="btn btn-primary " 
                    @else 
                        class="btn btn-default " 
                    @endif
                    role="button">{{$data->tahun}}</a>
            @endforeach
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Master Standart Biaya</h3>
                </div><!-- /.box-header -->
                
                <div class="box-body">
    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

    @if($tahun == 0) 
        Pilih Tahun 
    @else
    <div style="padding:5px"><a href="{{url::to('/standarBiaya/tambah/'.$tahun)}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Barang</a></div>
    <hr>
        <table id="dataAkun" class="table table-bordered">
        <thead>
            <tr>
            <th width="5%">No</th>
            <th width="30%">Nama Barang</th>
            <th width="15%">Harga Satuan</th>
            <th width="15%">Dasar Penentuan</th>
            <th width="15%">Lampiran</th>
            <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $urut=1; ?>
            @foreach($standar as $data)
                <tr>
                    <td style="text-align:center">{{{$urut++}}}</td>
                    <td>{{{$data->nama_barang}}}</td>
                    <td style="text-align:right">{{{getNumber($data->harga_satuan)}}}</td>
                    <td>{{{$data->dasar_harga}}}</td>
                    <td style="text-align:center">
                        @if($data->lampiran == NULL) 
                            {{-- //jika kosong --}}
                        @else
                        <a href="{{asset('storage/standar_biaya/'.$data->lampiran)}}" class="btn btn-sm btn-success"><i class="fa fa-download"></i> Download</a>
                        @endif
                    </td>
                    <td>
                    <div class="btn-group">
                        <a href="{{url::to('/standarBiaya/edit/'.$tahun.'/'.$data->id_kebutuhan_barang)}}" class="btn btn-info btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="{{url::to('/standarBiaya/hapus/'.$tahun.'/'.$data->id_kebutuhan_barang)}}" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></a>
                    </div>
                    </td>
                </tr>

                <!-- modal menampilkan file lampiran -->
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