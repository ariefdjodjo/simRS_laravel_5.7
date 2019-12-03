@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Detail Telaah</li>
          </ol>
@stop
@section('content')
    <div class="box box-success box-border">
        <div class="box-header">
            <table width="100%">
                <tr>
                    <td width="50%">
                        
                    </td>
                    <td  width="50%" style="text-align:right">
                        <div class="btn-group span-6">
                            <a href="{{url::to('telaah/pdfTelaah/'.$id)}}" target="blank" class="btn btn-success"><i class="fa fa-print"></i> Cetak Telaah</a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <td style="text-align:center" width="20%">
                        <img src="{{url('img/sardjito.png')}}" alt="" style="width:50%">
                    </td>
                    <td style="text-align:center" width="50%">
                        <h3>TELAAH KEBUTUHAN</h3>
                        <h4>TAHUN {{$data->tahun}}</h4>
                    </td>
                    <td width="30%" style="padding:30px 0px 0px 20px;">
                        Kepada Yth. <br>
                        <b>Direktur Keuangan</b><br>
                        di RSUP Dr. Sardjito Yogyakarta
                    </td>
                </tr>
                <tr>
                    <td>Nomor Telaah</td>
                    <td colspan="2">: {{$data->no_telaah}}</td>
                </tr>
                <tr>
                    <td>Tanggal Telaah</td>
                    <td colspan="2">: {{getTfi($data->tgl_telaah)}}</td>
                </tr>

                <tr>
                    <td>Perihal Telaah</td>
                    <td colspan="2">: Telaah {{$data->perihal_usulan}}</td>
                </tr>
                <tr>
                    <td>Unit Kerja Pengusul</td>
                    <td>: {{$data->nama_unit_kerja}}</td>
                </tr>
                <tr>
                    <td><b>Analisis Kebutuhan dan Kondisi Saat ini</b></td>
                    <td><?php echo $data->analisis_kebutuhan; ?></td>
                </tr>
                <tr>
                    <td><b>Alasan Kebutuhan</b></td>
                    <td><?php echo $data->alasan_kebutuhan; ?></td>
                </tr>
                <tr>
                    <td><b>Urgensi</b></td>
                    <td>{{getUrgensi($data->urgency)}}</td>
                </tr>
                <tr>
                    <td><b>Total RAB Telaah</b></td>
                    <td>
                        {{getRupiah($total)}} <br>
                        <i>( {{terbilang($total)}} rupiah )</i>
                    </td>
                </tr>
                <tr>
                    <td><b>Lampiran</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" style="text-align:center">
                        Mengetahui, <br>
                        {{$data->jabatan}}, <br><br><br><br><br>
                        <b>{{$data->nama_penelaah}}</b> <br>
                        {{$data->nip_penelaah}}
                    </td>
                </tr>
            </table>
            <h3>Lampiran</h3>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr style="text-align:center">
                        <td><b>No</b></td>
                        <td><b>Nama Barang</b></td>
                        <td><b>Spesifikasi</b></td>
                        <td><b>Kebutuhan</b></td>
                        <td><b>Satuan</b></td>
                        <td><b>Harga Satuan</b></td>
                        <td><b>Jumlah</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $urut = 1;  
                    ?>
                    @foreach ($barang as $item)
                   
                    <tr>
                        <td>{{$urut++}}</td>
                        <td>{{$item->nama_barang}}</td>
                        <td>{{$item->spesifikasi}}</td>
                        <td style="text-align:right">{{getNumber($item->qty_telaah)}}</td>
                        <td>{{$item->satuan}}</td>
                        <td style="text-align:right">{{getNumber($item->harga_telaah)}}</td>
                        <td style="text-align:right">{{getNumber($item->qty_telaah*$item->harga_telaah)}}</td>
                    </tr>    
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" style="text-align:right"><b> TOTAL</b></td>
                        <td style="text-align:right"><b>{{getNumber($total)}}</b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif



@endsection

@section('script')

    <script>
      $(function () {

        $('#tbl_barang').DataTable({"pageLength": 10});

      });

    </script>

<script>
          $('[data-toggle="popover"]').popover();
      </script>

@endsection