<html>
    <head>
        <link href="{{URL::asset('css/print.css')}}"  rel="stylesheet"  type="text/css" >
        <title>{{$usulan->no_usulan}}</title>
    </head>
    <body>
        <div id="page">
            <img src="{{url('img/kop_surat.png')}}" alt="" style="width:100%">
            <div style="margin : 0.3cm 0.3cm 0.2cm 0.3cm;">
                <div align="center">
                    <h2>NOTA DINAS</h2>
                    <h4>Nomor : {{$usulan->no_usulan}}</h4>
                    <br><br>
                    <div style="margin: 0 2cm 0 2cm">
                        <table width="100%" align="center" >
                            <tr>
                                <td>Yang Terhormat</td>
                                <td>:</td>
                                <td>Direktur Umum dan Operasional</td>
                            </tr>
                            <tr>
                                <td>Dari</td>
                                <td>:</td>
                                <td>{{$usulan->jabatan}}</td>
                            </tr>
                            <tr>
                                <td valign="top">Perihal</td>
                                <td valign="top">:</td>
                                <td>{{$usulan->perihal_usulan}}</td>
                            </tr>
                            <tr>
                                <td valign="top">Tanggal</td>
                                <td valign="top">:</td>
                                <td>{{getTfi($usulan->tgl_usulan)}}</td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <hr>
                </div>
                <div style="padding:15px">
                    <p>Dengan hormat,</p> 

                    <?php echo $usulan->isi_usulan; ?>

                </div>
                <br>
                <table width="100%">
                    <tr>
                        <td width=50%></td>
                        <td width=50% style="text-align:center">
                            {{$usulan->jabatan}} <br>
                            <br><br><br><br>
                            {{$usulan->nama_kepala}} <br>
                            NIP. {{$usulan->nip_kepala}}
                        </td>
                    </tr>
                </table>
                                
            </div>
            
           <!--  /** lampiran **/ -->
            <div style="page-break-before: always; text-align:center;" >
                <h3>LAMPIRAN SURAT USULAN</h3><br>
            </div>

            <div style="padding: 0.5cm 0.5cm 0.5cm 0.5cm">
                <table width="100%">
                    <tr>
                        <td>Nomor</td>
                        <td>:</td>
                        <td>{{$usulan->no_usulan}}</td>
                    </tr>

                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>{{getTfi($usulan->tgl_usulan)}}</td>
                    </tr>
                </table>
                <br>
                <table class="grid" width="100%">
                    <thead>
                        <tr>
                            <td>NO</td>
                            <td>NAMA BARANG</td>
                            <td>SPESIFIKASI</td>
                            <td>QTY</td>
                            <td>SATUAN</td>
                            <td>HARGA SATUAN</td>
                            <td>JUMLAH</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $urut_barang = 1;
                        $total = 0;
                    ?>
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
                Terbilang : {{terbilang($total)}} rupiah
            </div>

        </div>
    </body>
</html>

