<?php $urut=1; $total=0; ?>
<html>
    <head>
        <link href="{{URL::asset('css/print.css')}}"  rel="stylesheet"  type="text/css" >
        <title>Rekap Usulan</title>
    </head>
    <body>
        <div id="page">
            <div>
                <h2>REKAP USULAN KEBUTUHAN TAHUN {{$tahun}}</h2>
                <h2>{{$satker->nama_unit_kerja}}</h2>
                <hr>
                <br>
            </div>
                <table class="grid" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="45%">Jenis Usulan</th>
                                <th width="35%">RAB</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usulan as $data)
                                <tr>
                                    <td>{{$urut++}}</td>
                                    <td>{{getJenis($data->jenis_usulan)}}</td>
                                    <td style="text-align:right">{{getNumber($data->jum_usulan)}}</td>
                                </tr>
        
                                <?php $total+=$data->jum_usulan; ?>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">Total</td>
                                <td style="text-align:right">{{getNumber($total)}}</td>
                            </tr>
                            
                        </tfoot>
                    </table>

        </div>
    </body>
</html>

