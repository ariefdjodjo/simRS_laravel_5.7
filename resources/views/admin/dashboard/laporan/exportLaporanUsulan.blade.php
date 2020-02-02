<?php $urut=1; $total=0; ?>

<div>
    <h2>REKAP USULAN KEBUTUHAN TAHUN {{$tahun}}</h2>
    <h2>{{$satker->nama_unit_kerja}}</h2>
    <hr>
    <br>
</div>
<table class="grid" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Jenis</th>
            <th>Tahun</th>
            <th>No. Usulan</th>
            <th>Tgl. Usulan</th>\
            <th>Perihal</th>
            <th>RAB</th>
            <th>Satuan Kerja</th>
            <th>Penandatangan</th>
            <th>Tgl Kirim</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usulan as $data)
            <tr>
                <td>{{$urut++}}</td>
                <td>{{getJenis($data->jenis_usulan)}}</td>
                <td>{{$tahun}}</td>
                <td>{{$data->no_usulan}}</td>
                <td>{{$data->tgl_usulan}}</td>
                <td>{{$data->perihal_usulan}}</td>
                <td style="text-align:right">{{getNumber($data->jum_usulan)}}</td>
                <td>{{$satker->nama_unit_kerja}}</td>
                <td>{{$data->nama_kepala}}</td>
                <td>{{$data->tgl_kirim}}</td>
            </tr>
        @endforeach
    </tbody>
    {{-- <tfoot>
        <tr>
            <td colspan="2">Total</td>
            <td style="text-align:right">{{getNumber($total)}}</td>
        </tr>
    </tfoot> --}}
</table>

