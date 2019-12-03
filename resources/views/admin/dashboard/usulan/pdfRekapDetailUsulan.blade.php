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
                <table class="grid" width="100%" id="draftUsulan">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Nomor Usulan</th>
                            <th width="10%">Tanggal</th>
                            <th width="25%">Perihal Usulan</th>
                            <th width="15%">RAB</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usulan as $data)
                            <tr>
                                <td>{{$urut++}}</td>
                                <td>{{$data->no_usulan}}</td>
                                <td>{{getTfi($data->tgl_usulan)}}</td>
                                <td>{{$data->perihal_usulan}}</td>
                                <td style="text-align:right">{{getNumber($data->jum)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </body>
</html>