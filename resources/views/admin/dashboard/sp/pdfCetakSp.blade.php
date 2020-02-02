<html>
    <head>
        <link href="{{URL::asset('css/print.css')}}"  rel="stylesheet"  type="text/css" >
        <title>{{$sp->no_sp}} - {{$sp->hal_sp}}</title>
    </head>
    <body>
        @if ($template==1)
        <div id="page">
                <img src="{{url('img/kop_surat.png')}}" alt="" style="width:100%">
                <div style="margin : 0.3cm 0.3cm 0.2cm 0.3cm;">
                        <div>
                            <table class="biasa" width="100%">
                                <tr>
                                    <td width="5%">Nomor</td>
                                    <td width="0.3%">:</td>
                                    <td width="55%">{{$sp->no_sp}}</td>
                                    <td width="40%">{{getTfi($sp->tgl_sp)}}</td>
                                </tr>
                    
                                <tr>
                                    <td>Lampiran</td>
                                    <td>:</td>
                                    <td>Satu Berkas</td>
                                    <td></td>
                                </tr>
                                
                                <tr>
                                    <td valign="top">Perihal</td>
                                    <td  valign="top">:</td>
                                    <td valign="top">Surat Persetujuan (SP)<br>{{$sp->hal_sp}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><br>
                                        Kepada Yth. <br>
                                        {{$sp->sA->ppk->jabatan_ppk}} <br>
                                        RSUP Dr. Sardjito Yogyakarta<br>
                                        di Yogyakarta
                                        <br><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        Berdasarkan :
                                        <table class="biasa" width="100%">
                                            <tr>
                                                <td width="3%" valign="top">1. </td>
                                                <td width="97%" align="justify" valign="top">
                                                    Surat Nota Dinas dari {{$sp->telaah->usulan->unitKerja->nama_unit_kerja}} Nomor : {{$sp->telaah->usulan->no_usulan}} tanggal {{getTfi($sp->telaah->usulan->tgl_usulan)}} tentang {{$sp->telaah->usulan->perihal_usulan}}.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="3%" valign="top">2. </td>
                                                <td width="97%" align="justify" valign="top">
                                                    Surat Telaah dari {{$sp->telaah->ttd->jabatan}} Nomor : {{$sp->telaah->no_telaah}} tanggal {{getTfi($sp->telaah->tgl_telaah)}} tentang Telaah {{$sp->telaah->usulan->perihal_usulan}}
                                                </td>
                                            </tr>
                                        </table>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="justify">
                                        Setelah mempertimbangkan urgensinya, maka disetujui {{$sp->hal_sp}} dengan rincian sebagai berikut:
                                    </td>
                                </tr>
    
                                <tr>
                                    <td colspan="4">
                                        <table width="100%" class="grid">
                                            <tr>
                                                <th width="7%">No</th>
                                                <th width="30%">Nama Barang</th>
                                                <th width="10%">Volume</th>
                                                <th width="15%">Satuan</th>
                                                <th width="15%">Harga Satuan<br>(Rp.)</th>
                                                <th width="15%">Jumlah Harga</th>
                                            </tr>
                                            
                                            <?php
                                                $no = 1;
                                                $total = 0;
                                            ?>
                                            @foreach ($sp->barangSp as $itemSp)
                                                
                                            <?php 
                                                $jumHarga = $itemSp->qty_sp*$itemSp->harga_satuan_sp; 
                                                $total+=$jumHarga;
                                            ?>
                                            <tr>
                                                <td align="center" valign="top"><?php echo $no++; ?></td>
                                                <td valign="top">{{$itemSp->nama_barang_sp}}</td>
                                                <td valign="top" align="right">{{getNumber($itemSp->qty_sp)}}</td>
                                                <td valign="top">{{$itemSp->satuan_sp}}</td>
                                                <td valign="top" align="right">{{getNumber($itemSp->harga_satuan_sp)}}</td>
                                                <td valign="top" align="right">{{getNumber($jumHarga)}}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="5"><b>TOTAL HARGA</b></td>
                                                <td align="right">{{getNumber($total)}}</td>
                                            </tr>
                                        </table><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="justify" colspan="4">
                                        Rencana anggaran biaya sebesar Rp {{getNumber($total)}} ({{terbilang($total)}} rupiah) dibebankan pada sumber dana DIPA BLU Tahun {{$sp->sA->akun->tahun}} - {{$sp->sA->akun->sumber_dana}} MA {{getMA($sp->sA->id_sub_alokasi)}} Sub Alokasi
                                        {{$sp->sA->uraian_sub_alokasi}}.
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="4" align="justify" >
                                        <br>Demikian untuk dilaksanakan sesuai peraturan perundangan yang berlaku.
                                    </td>
                                </tr>
                            </table>
                            <br><br>
                            <table width="100%">
                                <tr>
                                    <td width="60%"></td>
                                    <td width="40%" align="center">
                                        {{$sp->penandatangan->jabatan}}
                                        <br><br><br><br><br><br><br>
                                        {{$sp->penandatangan->nama_penandatangan}} <br>
                                        NIP. {{$sp->penandatangan->nip_penandatangan}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                    <div style="padding:15px">
    
                    </div>
                    <br>              
                </div>
            </div>
        @elseif($template == 2)
        <div id="page">
                <img src="{{url('img/kop_surat.png')}}" alt="" style="width:100%">
                <div style="margin : 0.3cm 0.3cm 0.2cm 0.3cm;">
                        <div style="margin: 0 1cm 0 1cm">
                            <table class="biasa" width="100%">
                                <tr>
                                    <td width="10%">Nomor</td>
                                    <td width="2%">:</td>
                                    <td width="60%">{{$sp->no_sp}}</td>
                                    <td width="20%">{{getTfi($sp->tgl_sp)}}</td>
                                </tr>
                    
                                <tr>
                                    <td>Lampiran</td>
                                    <td>:</td>
                                    <td>Satu Berkas</td>
                                    <td></td>
                                </tr>
                                
                                <tr>
                                    <td valign="top">Perihal</td>
                                    <td  valign="top">:</td>
                                    <td valign="top">Surat Persetujuan (SP)<br>{{$sp->hal_sp}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><br>
                                        Kepada Yth. <br>
                                        {{$sp->sA->ppk->jabatan_ppk}} <br>
                                        RSUP Dr. Sardjito Yogyakarta<br>
                                        di Yogyakarta
                                        <br><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        Berdasarkan :
                                        <table class="biasa" width="100%">
                                            <tr>
                                                <td width="3%">1. </td>
                                                <td width="97%" align="justify">
                                                    Surat Nota Dinas dari {{$sp->telaah->usulan->unitKerja->nama_unit_kerja}} Nomor : {{$sp->telaah->usulan->no_usulan}} tanggal {{getTfi($sp->telaah->usulan->tgl_usulan)}} tentang {{$sp->telaah->usulan->perihal_usulan}}.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="3%">2. </td>
                                                <td width="97%" align="justify">
                                                    Surat Telaah dari {{$sp->telaah->ttd->jabatan}} Nomor : {{$sp->telaah->no_telaah}} tanggal {{getTfi($sp->telaah->tgl_telaah)}} tentang Telaah {{$sp->telaah->usulan->perihal_usulan}}
                                                </td>
                                            </tr>
                                        </table>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="justify">
                                        Setelah mempertimbangkan urgensinya, maka disetujui {{$sp->hal_sp}} dengan rincian sebagai berikut:
                                    </td>
                                </tr>
    
                                <tr>
                                    <td colspan="4">
                                        <table width="100%" class="grid">
                                            <tr>
                                                <th width="7%">No</th>
                                                <th width="30%">Nama Barang</th>
                                                <th width="10%">Volume</th>
                                                <th width="15%">Satuan</th>
                                                <th width="15%">Harga Satuan<br>(Rp.)</th>
                                                <th width="15%">Jumlah Harga</th>
                                            </tr>
                                            
                                            <?php
                                                $no = 1;
                                                $total = 0;
                                            ?>
                                            @foreach ($sp->barangSp as $itemSp)
                                                
                                            <?php 
                                                $jumHarga = $itemSp->qty_sp*$itemSp->harga_satuan_sp; 
                                                $total+=$jumHarga;
                                            ?>
                                            <tr>
                                                <td align="center" valign="top"><?php echo $no++; ?></td>
                                                <td valign="top">{{$itemSp->nama_barang_sp}}</td>
                                                <td valign="top" align="right">{{getNumber($itemSp->qty_sp)}}</td>
                                                <td valign="top">{{$itemSp->satuan_sp}}</td>
                                                <td valign="top" align="right">{{getNumber($itemSp->harga_satuan_sp)}}</td>
                                                <td valign="top" align="right">{{getNumber($jumHarga)}}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="5"><b>TOTAL HARGA</b></td>
                                                <td align="right">{{getNumber($total)}}</td>
                                            </tr>
                                        </table><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="justify" colspan="4">
                                        Rencana anggaran biaya sebesar Rp {{getNumber($total)}} ({{terbilang($total)}} rupiah) dibebankan pada sumber dana DIPA BLU Tahun {{$sp->sA->akun->tahun}} - {{$sp->sA->akun->sumber_dana}} MA {{getMA($sp->sA->id_sub_alokasi)}} Sub Alokasi
                                        {{$sp->sA->uraian_sub_alokasi}}.
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="4" align="justify" >
                                        <br>Demikian untuk dilaksanakan sesuai peraturan perundangan yang berlaku.
                                    </td>
                                </tr>
                            </table>
                            <br><br>
                            <table width="100%">
                                <tr>
                                    <td width="60%"></td>
                                    <td width="40%" align="center">
                                        {{$sp->penandatangan->jabatan}}
                                        <br><br><br><br><br><br><br>
                                        {{$sp->penandatangan->nama_penandatangan}} <br>
                                        NIP. {{$sp->penandatangan->nip_penandatangan}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                    <div style="padding:15px">
    
                    </div>
                    <br>              
                </div>
                
               <!--  /** lampiran **/ -->
                <div style="page-break-before: always; text-align:center;" >
                    <h3>LAMPIRAN SURAT PERSETUJUAN PENGADAAN</h3><br>
                </div>
    
                <div style="padding: 0.5cm 0.5cm 0.5cm 0.5cm">
                    
                </div>
    
            </div>
        @else 
            <div id="page">
                <img src="{{url('img/kop_surat.png')}}" alt="" style="width:100%">
                <div style="margin : 0.3cm 0.3cm 0.2cm 0.3cm;">
                        <div style="">
                            <table class="biasa" width="100%">
                                <tr>
                                    <td width="9%">Nomor</td>
                                    <td width="1%">:</td>
                                    <td width="60%">{{$sp->no_sp}}</td>
                                    <td width="30%">{{getTfi($sp->tgl_sp)}}</td>
                                </tr>
                    
                                <tr>
                                    <td>Lampiran</td>
                                    <td>:</td>
                                    <td>Satu Berkas</td>
                                    <td></td>
                                </tr>
                                
                                <tr>
                                    <td valign="top">Perihal</td>
                                    <td  valign="top">:</td>
                                    <td valign="top">Surat Persetujuan (SP)<br>{{$sp->hal_sp}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><br>
                                        Kepada Yth. <br>
                                        {{$sp->sA->ppk->jabatan_ppk}} <br>
                                        RSUP Dr. Sardjito Yogyakarta<br>
                                        di Yogyakarta
                                        <br><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        Berdasarkan :
                                        <table class="biasa" width="100%">
                                            <tr>
                                                <td width="3%" valign="top">1. </td>
                                                <td width="97%" align="justify" valign="top">
                                                    Surat Nota Dinas dari {{$sp->telaah->usulan->unitKerja->nama_unit_kerja}} Nomor : {{$sp->telaah->usulan->no_usulan}} tanggal {{getTfi($sp->telaah->usulan->tgl_usulan)}} tentang {{$sp->telaah->usulan->perihal_usulan}}.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="3%" valign="top">2. </td>
                                                <td width="97%" align="justify" valign="top">
                                                    Surat Telaah dari {{$sp->telaah->ttd->jabatan}} Nomor : {{$sp->telaah->no_telaah}} tanggal {{getTfi($sp->telaah->tgl_telaah)}} tentang Telaah {{$sp->telaah->usulan->perihal_usulan}}
                                                </td>
                                            </tr>
                                        </table>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="justify">
                                        Setelah mempertimbangkan urgensinya, maka disetujui {{$sp->hal_sp}} dengan rincian terlampir.
                                    </td>
                                </tr>
                                <?php $tot = 0; ?>
                                @foreach ($sp->barangSp as $item)
                                    <?php $tot+= $item->qty_sp*$item->harga_satuan_sp; ?>
                                @endforeach
                                <tr>
                                    <td align="justify" colspan="4">
                                        Rencana anggaran biaya sebesar Rp {{getNumber($tot)}} ({{terbilang($tot)}} rupiah) dibebankan pada sumber dana DIPA BLU Tahun {{$sp->sA->akun->tahun}} - {{$sp->sA->akun->sumber_dana}} MA {{getMA($sp->sA->id_sub_alokasi)}} Sub Alokasi
                                        {{$sp->sA->uraian_sub_alokasi}}.
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="4" align="justify" >
                                        <br>Demikian untuk dilaksanakan sesuai peraturan perundangan yang berlaku.
                                    </td>
                                </tr>
                            </table>
                            <br><br>
                            <table width="100%">
                                <tr>
                                    <td width="60%"></td>
                                    <td width="40%" align="center">
                                        {{$sp->penandatangan->jabatan}}
                                        <br><br><br><br><br><br><br>
                                        {{$sp->penandatangan->nama_penandatangan}} <br>
                                        NIP. {{$sp->penandatangan->nip_penandatangan}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                    <div style="padding:15px">
    
                    </div>
                    <br>              
                </div>
                
               <!--  /** lampiran **/ -->
                <div style="page-break-before: always; text-align:center;" >
                    <h3>LAMPIRAN SURAT PERSETUJUAN PENGADAAN</h3><br>
                </div>
    
                <div style="padding: 0.5cm 0.5cm 0.5cm 0.5cm">
                        <table width="100%" class="grid">
                                <tr>
                                    <th width="7%">No</th>
                                    <th width="30%">Nama Barang</th>
                                    <th width="10%">Volume</th>
                                    <th width="15%">Satuan</th>
                                    <th width="15%">Harga Satuan<br>(Rp.)</th>
                                    <th width="15%">Jumlah Harga</th>
                                </tr>

                                <?php
                                    $no = 1;
                                    $total = 0;
                                ?>
                                @foreach ($sp->barangSp as $itemSp)
                                    
                                <?php 
                                    $jumHarga = $itemSp->qty_sp*$itemSp->harga_satuan_sp; 
                                    $total+=$jumHarga;
                                ?>
                                <tr>
                                    <td align="center" valign="top"><?php echo $no++; ?></td>
                                    <td valign="top">{{$itemSp->nama_barang_sp}}</td>
                                    <td valign="top" align="right">{{getNumber($itemSp->qty_sp)}}</td>
                                    <td valign="top">{{$itemSp->satuan_sp}}</td>
                                    <td valign="top" align="right">{{getNumber($itemSp->harga_satuan_sp)}}</td>
                                    <td valign="top" align="right">{{getNumber($jumHarga)}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5"><b>TOTAL HARGA</b></td>
                                    <td align="right">{{getNumber($total)}}</td>
                                </tr>
                            </table><br>
                </div>
    
            </div>
        @endif
        
    </body>
</html>

