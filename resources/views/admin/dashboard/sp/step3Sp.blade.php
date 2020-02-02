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
    @if ($sp->status_sp == "Aktif")
        <h2>Forbidden Access</h2>
    @else
    <div class="box box-primary">
        <div class="box-header">
            <ul id="progressbar" class="progressbar">
                    <li class="active" style="width: 20%;">Pilih Tahun Anggaran</li>
                    <li class="active" style="width: 20%;">Data SP Anggaran</li>
                    <li class="active" style="width: 20%;">Data Item Barang</li>
                    <li class="" style="width: 20%;">Cetak dan Kirim</li>
                    <li style="width: 20%;">Selesai</li>             
            </ul>
        </div>
        <hr>
        <div class="box-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Usulan Barang <span class="badge bg-purple">{{$countBarangTelaah}}</span></a></li>
                    <li class="success"><a data-toggle="tab" href="#menu1">
                        Barang Disetujui <span class="badge bg-green">{{$countBarangSp}}</span>
                    </a></li>
                </ul>
            </div>
            
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div style="font-size:30px; text-align:center">
                        <p><b>DAFTAR BARANG</b></p>
                    </div>
                    
                    <?php $urut = 1; $total=0; ?>
                    
                    <table class="table table-bordered" id="tableBarang">
                        <thead>
                            <tr>
                                <th style="text-align:center">No</th>
                                <th style="text-align:center">Nama Barang</th>
                                <th style="text-align:center">Spesifikasi</th>
                                <th style="text-align:center">Qty</th>
                                <th style="text-align:center">Satuan</th>
                                <th style="text-align:center">Harga Satuan</th>
                                <th style="text-align:center">Jumlah</th>
                                <th style="text-align:center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangTelaah as $item)
                                <?php $total+= $item->jumlah_harga_telaah; ?>
                                <tr>
                                    <td><?php echo $urut++; ?></td>
                                    <td>{{$item->nama_barang}}</td>
                                    <td>{{$item->spesifikasi}}</td>
                                    <td style="text-align:right">{{getNumber($item->qty_telaah)}}</td>
                                    <td>{{$item->satuan}}</td>
                                    <td style="text-align:right">{{getNumber($item->harga_telaah)}}</td>
                                    <td style="text-align:right">{{getNumber($item->jumlah_harga_telaah)}}</td>
                                    <td><a data-toggle="modal" data-target="#tambahBarang{{$item->id_barang_usulan}}" class="btn btn-sm btn-primary">Pilih</a></td>
                                </tr>

                                {{-- Modal Tambah --}}
                                <div class="modal modal-info fade" id="tambahBarang{{$item->id_barang_usulan}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Tambah Barang</h4>
                                            </div>
                                            
                                            <div class="modal-body">
                                                <div class="box-body">
                                                    <form action="{{url('spp/simpanBarangSp')}}" method="POST" onsubmit="return validasi()">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label text-md-right" for="halsp">Nama Barang</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="namaBarang" id="namaBarang" value="{{$item->nama_barang}}">
                                                                <input type="hidden" id="tahun" name="tahun" value="{{$tahun}}">
                                                                <input type="hidden" id="id_sp" name="id_sp" value="{{$id}}">
                                                                <input type="hidden" id="id_barang" name="id_barang" value="{{$item->id_barang_usulan}}">
                                                                <small class="help-block"></small>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label text-md-right" for="halsp">Spesifikasi Barang</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="spesifikasi" id="spesifikasi" value="{{$item->spesifikasi}}">
                                                                <small class="help-block"></small>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label text-md-right" for="halsp">Qty Barang</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="qty" id="qty" value="{{$item->qty_telaah}}">
                                                                <small class="help-block"></small>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label text-md-right" for="halsp">Satuan</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="satuan" id="satuan" value="{{$item->satuan}}">
                                                                <small class="help-block"></small>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label text-md-right" for="halsp">Harga Barang</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="harga" id="harga" value="{{$item->harga_telaah}}">
                                                                <small class="help-block"></small>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label text-md-right" for="halsp">Jumlah Harga</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="jumlah" id="jumlah" value="{{getNumber($item->jumlah_harga_telaah)}}" readonly>
                                                                <small class="help-block"></small>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                                <label class="col-md-4 control-label text-md-right" for="halsp"></label>
                                                                <div class="col-md-6">
                                                                    <input type="submit" value="Simpan" class="btn btn-primary">
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
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6">TOTAL</th>
                                <th style="text-align:right">{{getNumber($total)}}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <div style="font-size:30px; text-align:center">
                        <p><b>DAFTAR BARANG DISETUJUI</b></p>
                    </div>
                    <?php $urutan = 1; $totalnya = 0;?>
                    <table class="table table-bordered" id="tableBarangSp">
                        <thead>
                            <tr>
                                <th style="text-align:center">No</th>
                                <th style="text-align:center">Nama Barang</th>
                                <th style="text-align:center">Spesifikasi</th>
                                <th style="text-align:center">Qty</th>
                                <th style="text-align:center">Satuan</th>
                                <th style="text-align:center">Harga Satuan</th>
                                <th style="text-align:center">Jumlah</th>
                                <th style="text-align:center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangSp as $bSp)
                                <?php $totalnya+= $bSp->qty_sp*$bSp->harga_satuan_sp; ?>
                                <tr>
                                    <td><?php echo $urutan++; ?></td>
                                    <td>{{$bSp->nama_barang_sp}}</td>
                                    <td>{{$bSp->spesifikasi_barang_sp}}</td>
                                    <td style="text-align:right">{{getNumber($bSp->qty_sp)}}</td>
                                    <td>{{$bSp->satuan_sp}}</td>
                                    <td style="text-align:right">{{getNumber($bSp->harga_satuan_sp)}}</td>
                                    <td style="text-align:right">{{getNumber($bSp->harga_satuan_sp*$bSp->qty_sp)}}</td>
                                    <td><a data-toggle="modal" data-target="#hapus{{$bSp->id_barang_sp}}" class="btn btn-sm btn-danger">Hapus</a></td>
                                </tr>

                                {{-- Modal Tambah --}}
                                <div class="modal modal-warning fade" id="hapus{{$bSp->id_barang_sp}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Hapus Barang</h4>
                                                </div>
                                                
                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <form action="{{url('spp/hapusBarangSp')}}" method="POST" onsubmit="return validasi()">
                                                            @csrf
                                                            <div class="form-group">
                                                                <div class="col-md-10">
                                                                    Apakah Anda Yakin Menghapus Item Barang {{$bSp->nama_barang_sp}}?
                                                                    <input type="hidden" id="tahun" name="tahun" value="{{$tahun}}">
                                                                    <input type="hidden" id="id_sp" name="id_sp" value="{{$id}}">
                                                                    <input type="hidden" id="id_barang" name="id_barang" value="{{$bSp->id_barang_sp}}">
                                                                    <small class="help-block"></small>
                                                                </div>
                                                            </div>
    
                                                            <div class="form-group">
                                                                    <label class="col-md-4 control-label text-md-right" for="halsp"></label>
                                                                    <div class="col-md-6">
                                                                        <input type="submit" value="Hapus" class="btn btn-danger">
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
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6">TOTAL</th>
                                <th style="text-align:right">{{getNumber($totalnya)}}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
        </div>
        <div class="bg-orange color-palette" style="padding:2px 15px 2px 15px">
            <ul class="pager">
                <li class="previous success">
                    <a href="{{url('spp/tambah/step2/'.$tahun.'/'.$id)}}">&larr; KEMBALI STEP 2</a>
                </li>
                <li class="next">
                    <a href="{{url('spp/tambah/step4/'.$tahun.'/'.$id)}}"><i class="icon icon-ok"></i> LANJUT STEP 4 &rarr;</a>
                </li>
            </ul>
        </div>
        
    </div>
    @endif
@endsection

@section('script')    
    <script>
      $(function () {
        $('#tableBarang').DataTable({"pageLength": 10});
        $('#tableBarangSp').DataTable({"pageLength": 10});
      });
    </script>
@endsection