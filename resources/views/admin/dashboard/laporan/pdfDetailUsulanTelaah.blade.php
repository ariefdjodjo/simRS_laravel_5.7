<html>
    <head>
        <link href="{{URL::asset('css/print.css')}}"  rel="stylesheet"  type="text/css" >
        <title>Laporan Detail Telaah {{$tahun}}</title>
    </head>
    <body>
        <div id="page">
    <?php 
        $urut   = 1;
        $total = 0;
        $totalTelaah = 0;
        $totalSelisih = 0;
    ?>
    
            <b><h2 style="padding:0;">Rekap Usulan dan Telaah Belanja {{getJenis($jenis)}}</h2></b>

            <br>

            <table class="grid" id="rekapUsulan" width="100%" style="font-size:0.8em">
                <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th width="10%">No Telaah</th>
                        <th width="5%">Tgl. Telaah</th>
                        <th width="15%">Perihal</th>
                        <th width="10%">RAB Usulan</th>
                        <th width="10%">RAB Telaah</th>
                        <th width="10%">Sisa/Kurang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usulan as $data)
                        <?php $selisih = $data->jum_usulan-$data->jum_telaah; ?>
                        <tr>
                            <td>{{$urut++}}</td>
                            <td>{{$data->no_telaah}}</td>
                            <td>{{$data->tgl_telaah}}</td>
                            <td>{{$data->perihal_usulan}}</td>
                            <td style="text-align:right">{{getNumber($data->jum_usulan)}}</td>
                            <td style="text-align:right">{{getNumber($data->jum_telaah)}}</td>
                            <td style="text-align:right">{{getNumber($selisih)}}</td>
                        </tr>

                        <?php $total+=$data->jum_usulan; ?>
                        <?php $totalTelaah+=$data->jum_telaah; ?>
                        <?php $totalSelisih+=$selisih; ?>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">Total</td>
                        <td style="text-align:right">{{getNumber($total)}}</td>
                        <td style="text-align:right">{{getNumber($totalTelaah)}}</td>
                        <td style="text-align:right">{{getNumber($totalSelisih)}}</td>
                    </tr>
                    
                </tfoot>
            </table>
        </div>
    </body>
</html>