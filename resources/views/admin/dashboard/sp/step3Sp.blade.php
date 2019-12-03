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
    <div class="box box-primary">
        <div class="box-header">
            <ul id="progressbar" class="progressbar">
                <li class="active">Pilih Tahun Anggaran</li>
                <li class="active">Data SP Anggaran</li>
                <li class="active">Data Item Barang</li>
                <li class="">Selesai</li>            
            </ul>
        </div>
        <hr>
        <div class="box-body">
            <ul class="nav nav-tabs">
                <li class="primary active"><a data-toggle="tab" href="#home">Usulan Barang</a></li>
                <li><a data-toggle="tab" href="#menu1">Barang Disetujui</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div style="font-size:30px; text-align:center">
                        <p><b>DAFTAR BARANG</b></p>
                    </div>
                    
                    <?php $urut = 1; ?>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Spesifikasi</th>
                                <th>Qty</th>
                                <th>Satuan</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangTelaah as $item)
                                <tr>
                                    <td><?php echo $urut++; ?></td>
                                    <td>{{$item->nama_barang}}</td>
                                    <td>{{$item->spesifikasi}}</td>
                                    <td>{{$item->qty_telaah}}</td>
                                    <td>{{$item->satuan}}</td>
                                    <td>{{$item->harga_telaah}}</td>
                                    <td>{{$item->jumlah_harga_telaah}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6">TOTAL</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <h3>Menu 1</h3>
                    <p>Tutorial pemrograman web, mobile dan design</p>
                </div>
            </div>
            
        </div>
        <div class="box-footer">
            <ul class="pager">
                <li class="previous success">
                    <a href="{{url('spp/tambah/step4/'.$tahun.'/'.$id)}}">&larr; KEMBALI STEP 2</a>
                </li>
                <li class="next">
                    <a href="{{url('spp/tambah/step4/'.$tahun.'/'.$id)}}"><i class="icon icon-ok"></i> LANJUT STEP 4 &rarr;</a>
                </li>
            </ul>
        </div>
        
    </div>

@endsection