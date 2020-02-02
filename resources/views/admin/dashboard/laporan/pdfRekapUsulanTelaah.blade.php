<html>
    <head>
        <link href="{{URL::asset('css/print.css')}}"  rel="stylesheet"  type="text/css" >
        <title>Laporan Telaah {{$tahun}}</title>
    </head>
    <body>
        <div id="page">
            <div style="margin : 0.3cm 0.3cm 0.2cm 0.3cm;">
                <?php 
                    $urut   = 1;
                    $total = 0;
                    $totalTelaah = 0;
                    $totalSelisih = 0;
                ?>
                <b><h2 style="padding:0;">Rekap Usulan dan Telaah Tahun {{$tahun}}</h2></b>
<br>

            <table class="grid" id="rekapUsulan" width="100%">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="35%">Uraian</th>
                        <th width="20%">RAB Usulan</th>
                        <th width="20%">RAB Telaah</th>
                        <th width="20%">Sisa/Kurang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usulan as $data)
                        <?php $selisih = $data->jum_usulan-$data->jum_telaah; ?>
                        <tr>
                            <td>{{$urut++}}</td>
                            <td>{{getJenis($data->jenis_usulan)}}</td>
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
                        <td colspan="2">Total</td>
                    <td style="text-align:right">{{getNumber($total)}}</td>
                    <td style="text-align:right">{{getNumber($totalTelaah)}}</td>
                    <td style="text-align:right">{{getNumber($totalSelisih)}}</td>
                    </tr>
                    
                </tfoot>
            </table>
            

        </div>
    </body>
</html>