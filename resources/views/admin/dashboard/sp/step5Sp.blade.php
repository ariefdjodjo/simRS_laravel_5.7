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
    <head>
        <style>
            body {
                position: relative;
            }
            .affix {
                top: 20px;
                z-index: 9999 !important;
            }
        </style>
    </head>
    <body data-spy="scroll" data-target="#myScrollspy" data-offset="15">

        <div class="box box-primary">
                <div class="box-header">
                    <ul id="progressbar" class="progressbar">
                        <li class="active" style="width: 20%;">Pilih Tahun Anggaran</li>
                        <li class="active" style="width: 20%;">Data SP Anggaran</li>
                        <li class="active" style="width: 20%;">Data Item Barang</li>
                        <li class="active" style="width: 20%;">Cetak dan Kirim</li>
                        <li class="active" style="width: 20%;">Selesai</li>            
                    </ul>
                </div>
                <hr>
                <div class="bg-info row" style="padding:5px; margin: 5px;">
                    <div class="pull-left">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-print"></i> Cetak <span class="fa fa-caret-down"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" onclick="cetak1()"><i class="fa fa-book"></i> Cetak Default</a></li>
                                    <li><a href="#" onclick="cetak2()"><i class="fa fa-sticky-note"></i> Cetak Tanpa Lampiran</a></li>
                                    <li><a href="#" onclick="cetak3()"><i class="fa fa-clone"></i> Cetak Dengan Lampiran</a></li>
                                </ul>
                            @if ($sp->status_sp != "Batal")
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#batal">
                                    <i class="fa fa-remove"></i> Batal
                                </button>
                            @else 
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#batal" title="Aktifkan Kembali"><i class="fa fa-check-circle"></i></button>
                            @endif
                        </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-primary"><i class="fa fa-get-pocket"></i> </button> Terkirim
                    </div>  
                </div>

                <div class="box-body" data-spy="scroll" data-target="#myScrollspy">
                    <div class="row">
                        <div class="col-sm-3" id="myScrollspy">
                            <ul class="nav nav-pills nav-stacked color-palette-set" data-spy="affix" data-offset-top="205">
                                <li class="bg-purple"><a href="#sp_anggaran"><span><i class="fa fa-chevron-right"></i> SP Anggaran </a></span></li>
                                <li class="bg-yellow color-palette" style="font-color:white"><a href="#itemBarang"><i class="fa fa-chevron-right"></i> Item Barang SP</a></li>
                                <li class="bg-success"><a href="#usulan"><i class="fa fa-chevron-right"></i> Dasar Usulan</a></li>
                                <li class="bg-teal"><a href="#telaah"><i class="fa fa-chevron-right"></i> Dasar Telaah</a></li>
                                <li class="bg-gray"><a href="#dokumen"><i class="fa fa-chevron-right"></i> Dokumen Pendukung</a></li>
                            </ul>
                        </div>

                        <div class="col-sm-9">
                            <section id="sp_anggaran"  style="padding-top:0;">
                                <div class="box box-solid box-primary">
                                    <div class="box-header">SP Anggaran</div>
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td><b>No. SP Anggaran</b></td>
                                                <td>{{$sp->no_sp}}</td>
                                                <td><b>Tanggal SP</b></td>
                                                <td>{{getTfi($sp->tgl_sp)}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Perihal</b></td>
                                                <td colspan="3">{{$sp->hal_sp}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Sub Alokasi</b></td>
                                                <td>{{$sp->sA->uraian_sub_alokasi}}</td>
                                                <td><b>Sumber Dana</b></td>
                                                <td>{{$sp->sA->akun->sumber_dana}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Kode MA</b></td>
                                                <td colspan="3">{{getMA($sp->sA->id_sub_alokasi)}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Catatan</b></td>
                                                <td colspan="3">
                                                    <?php echo $sp->catatan_sp; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Status</b></td>
                                                <td>
                                                    @if ($sp->status_sp == NULL)
                                                        <small class="label bg-orange">Draft</small>
                                                    @elseif($sp->status_sp == "Aktif")
                                                        <small class="label bg-purple">Aktif</small>
                                                    @else
                                                        <small class="label bg-maroon">Batal</small>
                                                    @endif
                                                </td>
                                                <td><b>Tanggal Kirim</b></td>
                                                <td>
                                                    @if ($sp->tgl_kirim_sp != NULL)
                                                        {{getTfi($sp->tgl_kirim_sp)}}
                                                    @else
                                                        Belum Dikirim
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </section>

                            <section id="itemBarang" style="padding-top:0;">
                                <div class="box box-solid box-success" >
                                    <div class="box-header">
                                        Item Barang SP
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-bordered" id="barang">
                                            <thead>
                                                <tr>
                                                        <th style="text-align:center">No</th>
                                                        <th style="text-align:center">Nama Barang</th>
                                                        <th style="text-align:center">Spesifikasi</th>
                                                        <th style="text-align:center">Qty</th>
                                                        <th style="text-align:center">Satuan</th>
                                                        <th style="text-align:center">Harga Satuan</th>
                                                        <th style="text-align:center">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $totalnya = 0; $urutan = 1;?>
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
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="6">TOTAL</th>
                                                    <th style="text-align:right">{{getNumber($totalnya)}}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </section>

                            <section id="usulan"  style="padding-top:0;">
                                <div class="box box-solid box-warning">
                                    <div class="box-header">
                                        Data Usulan
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td><b>Satuan Kerja</b></td>
                                                <td>{{$sp->telaah->usulan->unitKerja->nama_unit_kerja}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>No Usulan</b></td>
                                                <td>{{$sp->telaah->usulan->no_usulan}}</td>
                                                <td><b>Tanggal Usulan</b></td>
                                                <td>{{getTfi($sp->telaah->usulan->tgl_usulan)}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Perihal</b></td>
                                                <td colspan="3">{{$sp->telaah->usulan->perihal_usulan}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Lampiran</b></td>
                                                <td colspan="3">
                                                    @foreach ($sp->telaah->usulan->lampiranUsulan as $lampUsulan)
                                                        {{$lampUsulan->nama_dokumen}}
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </section>

                            <section id="telaah" style="padding-top:0;">
                                <div class="box box-solid box-danger">
                                    <div class="box-header">
                                        Data Telaah
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td><b>Nomor Telaah</b></td>
                                                <td>{{$sp->telaah->no_telaah}}</td>
                                                <td><b>Tanggal Telaah</b></td>
                                                <td>{{getTfi($sp->telaah->tgl_telaah)}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Perihal Telaah</b></td>
                                                <td colspan="3">Telaah {{$sp->telaah->usulan->perihal_usulan}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Analisis Kebutuhan</b></td>
                                                <td colspan="3"><?php echo $sp->telaah->analisis_kebutuhan; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Alasan Kebutuhan</b></td>
                                                <td colspan="3"><?php echo $sp->telaah->alasan_kebutuhan; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Urgensi</b></td>
                                                <td>{{getUrgensi($sp->telaah->urgency)}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Lampiran</b></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </section>

                            <section id="dokumen" style="padding-top:0px;">
                                <div class="box box-solid box-info">
                                    <div class="box-header">
                                        Dokumen Pendukung
                                    </div>

                                    <div class="box-body">

                                    </div>
                                </div>
                            </section>
                        </div> 
                    </div>
                </div>
            </body>
        </div>
    </div>

    {{-- Modal Batal --}}
    <div class="modal fade" id="batal">
        <div class="modal-dialog" style="width:90%">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pembatalan SP</h4>
            </div>
            <div class="modal-body">
                <form action="{{url('spp/batal/'.$tahun.'/'.$id)}}" method="POST" onsubmit="return validasi()">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-2 control-label text-md-right" for="halsp">Catatan</label>
                        <div class="col-md-10">
                            <textarea name="catatan" id="catatan" class="form-control input-md"></textarea>
                            <small class="help-block"></small>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function(){
                          $('#catatan').wysihtml5();
                        });
                      </script>
                    <div class="form-group">
                        <label class="col-md-2 control-label text-md-right" for="halsp"></label>
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
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

@endsection

@section('script')  
    <script>
        function cetak1() {
            var data = "{{url('spp/cetakPdf/'.$id.'/1')}}";
            window.open(data, "_blank", "scrollbars=yes,resizable=yes,width=800,height=1000");
        }
        function cetak2() {
            var data = "{{url('spp/cetakPdf/'.$id.'/2')}}";
            window.open(data, "_blank", "scrollbars=yes,resizable=yes,width=800,height=1000");
        }
        function cetak3() {
            var data = "{{url('spp/cetakPdf/'.$id.'/3')}}";
            window.open(data, "_blank", "scrollbars=yes,resizable=yes,width=800,height=1000");
        }
    </script>
    <script>
      $(function () {
        $('#tableBarang').DataTable({"pageLength": 10});
        $('#tableBarangSp').DataTable({"pageLength": 10});
      });
    </script>
@endsection