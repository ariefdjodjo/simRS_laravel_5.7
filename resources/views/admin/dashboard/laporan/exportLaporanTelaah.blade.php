<?php 
    $urut   = 1;
    $total = 0;
    $totalTelaah = 0;
    $totalSelisih = 0;
?>

<h3>REKAP PENERBITAN TELAAH TAHUN {{$tahun}}</h3>

<table class="table table-bordered" id="rekapUsulan" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>No Telaah</th>
            <th>Tgl. Telaah</th>
            <th>Perihal</th>
            <th>RAB Usulan</th>
            <th>RAB Telaah</th>
            <th>Sisa/Kurang</th>
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