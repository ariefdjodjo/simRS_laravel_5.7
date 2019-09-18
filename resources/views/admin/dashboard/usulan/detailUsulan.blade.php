@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Draft Usulan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{URL::to('/usulan/draftUsulan/0')}}">Draft Usulan</a></li>
    <li class="active">Detail</li>
  </ol>
@stop

@section('content')

<?php 
    $urut = 1;
    $urut_barang = 1;
    $total = 0;
?>
<div class="box">
    <h3 align="center"><b>DATA USULAN PENGADAAN</b></h3>
    <hr>
    <div class="pull-right"><a href="" class="btn btn-warning">Selesai</a></div>
</div>
<div class="box box-solid box-primary">
    <div class="box-header">
        DATA USULAN
    </div>
    <div class="box-body">
        <dl class="dl-horizontal">
            <dt>Tahun</dt>
            <dd>{{$usulan->tahun}}</dd>

            <dt>No. Usulan</dt>
            <dd>{{$usulan->no_usulan}}</dd>

            <dt>Tanggal Usulan</dt>
            <dd>{{getTfi($usulan->tgl_usulan)}}</dd>

            <dt>Perihal Usulan</dt>
            <dd>{{$usulan->perihal_usulan}}</dd>

            <dt>Jenis Usulan</dt>
            <dd>{{getJenis($usulan->jenis_usulan)}}</dd>

            <dt>Isi Usulan</dt>
            <dd><?php echo $usulan->isi_usulan; ?></dd>
        </dl>
    </div>
</div>
<div class="box box-solid box-success">
    <div class="box-header">
        <div class="btn-group">
            Lampiran
        </div>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <td>NO</td>
                <td>NAMA</td>
            </tr>

            @foreach($lampiran as $lamp)
            <tr>
                <td>{{$urut++}}</td>
                <td>{{$lamp->nama_dokumen}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="box box-solid box-info">
    <div class="box-header">
        ITEM BARANG
    </div>
    <div class="box-body">
        <table class="table table-bordered" id="itemBarang">
            <thead>
                <tr>
                    <td>NO</td>
                    <td>NAMA BARANG</td>
                    <td>SPESIFIKASI</td>
                    <td>KEBUTUHAN</td>
                    <td>SATUAN</td>
                    <td>HARGA SATUAN</td>
                    <td>JUMLAH</td>
                    <td>#</td>
                </tr>
            </thead>
            <tbody>
                @foreach($barang as $item)
                <tr>
                    <td>{{$urut_barang++}}</td>
                    <td>{{$item->nama_barang}}</td>
                    <td>{{$item->spesifikasi}}</td>
                    <td style="text-align:right">{{getNumber($item->qty_usulan)}}</td>
                    <td>{{$item->satuan}}</td>
                    <td style="text-align:right">{{getNumber($item->harga_usulan)}}</td>
                    <td style="text-align:right">{{getNumber($item->jumlah_usulan)}}</td>
                    <?php
                        $total+=$item->jumlah_usulan;
                    ?>
                </tr>    
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">TOTAL</td>
                    <td  style="text-align:right">{{getNumber($total)}}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@if($usulan->tgl_kirim == NULL)
    <div class="box box-primary">
        <div class="pull-right">
            <a href="{{{URL::to('tambahItemBarang/'.$usulan->id_usulan)}}}" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
            <a href="{{{URL::to('usulan/kirim/'.$usulan->id_usulan)}}}" class="btn btn-warning"><i class="fa fa-inbox"></i> Kirim</a>
        </div>
        <br><br>
    </div>
@else
    <div class="box box-primary">
        <div class="pull-right">
            <a href="{{{URL::to('telaah/pdfUsulan/'.$usulan->id_usulan)}}}" class="btn btn-success" target="blank"><i class="fa fa-print"></i>Cetak</a>
        </div>
        <br><br>
    </div>
@endif

@endsection