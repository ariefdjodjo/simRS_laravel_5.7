<html>
    <head>
        <link href="{{URL::asset('css/print.css')}}"  rel="stylesheet"  type="text/css" >
        <title>{{$data->no_telaah}}</title>
    </head>
    <body>
        <div id="page">
            <div style="margin : 0.3cm 0.3cm 0.2cm 0.3cm;">
                <table class="grid">
                    <tr>
                        <td style="text-align:center" width="20%">
                            <img src="{{url('img/sardjito.png')}}" alt="" style="width:3000%">
                        </td>
                        <td style="text-align:center" width="50%">
                            <h3>TELAAH KEBUTUHAN</h3>
                            <h4>TAHUN {{$data->tahun}}</h4>
                        </td>
                        <td width="30%" style="padding:10px 0px 0px 10px;">
                            Kepada Yth. <br>
                            <b>Direktur Keuangan</b><br>
                            di RSUP Dr. Sardjito Yogyakarta
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:text-top">Nomor Telaah</td>
                        <td colspan="2">: {{$data->no_telaah}}</td>
                    </tr>
                    <tr>
                        <td style="vertical-align:text-top">Tanggal Telaah</td>
                        <td colspan="2">: {{getTfi($data->tgl_telaah)}}</td>
                    </tr>

                    <tr>
                        <td style="vertical-align:text-top">Perihal Telaah</td>
                        <td colspan="2">: Telaah {{$data->perihal_usulan}}</td>
                    </tr>
                    <tr>
                        <td style="vertical-align:text-top">Unit Kerja Pengusul</td>
                        <td colspan="2">: {{$data->nama_unit_kerja}}</td>
                    </tr>
                    <tr>
                        <td style="vertical-align:text-top"><b>Analisis Kebutuhan dan Kondisi Saat ini</b></td>
                        <td colspan="2"><?php echo $data->analisis_kebutuhan; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align:text-top"><b>Alasan Kebutuhan</b></td>
                        <td colspan="2"><?php echo $data->alasan_kebutuhan; ?></td>
                    </tr>
                    <tr>
                        <td><b>Urgensi</b></td>
                        <td colspan="2">{{getUrgensi($data->urgency)}}</td>
                    </tr>
                    <tr>
                        <td><b>Total RAB Telaah</b></td>
                        <td colspan="2">
                            {{getRupiah($total)}} <br>
                            <i>( {{terbilang($total)}} rupiah )</i>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Lampiran</b></td>
                        <td colspan="2"></td>
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
            </div>
            <div style="page-break-before: always; text-align:center;" >
                <h3>Lampiran</h3>
                <hr><br>
            </div>
            <table class="grid">
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
    </body>
</html>