@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Rekap Usulan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Rekap Usulan</li>
  </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <div class="btn-group">
                @foreach($th as $data)
                    <a href="{{{URL::to('rekapUsulan/'.$data->tahun)}}}" 
                        @if($tahun == $data->tahun)
                            class="btn btn-primary " 
                        @else 
                            class="btn btn-default " 
                        @endif
                        role="button">{{$data->tahun}}</a>
                @endforeach
            </div>
        </div>
    </div>

    <?php 
        $urut   = 1;
        $total = 0;
    ?>
    <div class="box box-primary">
        <div class="box-header">
            <b><h2 style="text-align:center">Data Usulan</h2></b>
        </div>
        <div class="box-body">
            @if($tahun==0)
            <h3>PILIH TAHUN</h3>
            @else
            <div>
                <a href="" class="btn btn-info"><i class="fa fa-print"></i> Cetak PDF</a>
                <a href="" class="btn btn-warning"><i class="fa fa-file-excel-o"></i> Eksport Excel</a>
            </div>
            <hr>

            <table class="table table-bordered" id="rekapUsulan" width="100%">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Uraian</th>
                        <th width="15%">RAB</th>
                        <th width="5%">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usulan as $data)
                        <tr>
                            <td>{{$urut++}}</td>
                            <td>{{getJenis($data->jenis_usulan)}}</td>
                            <td style="text-align:right">{{getNumber($data->jum_usulan)}}</td>
                            <td style="text-align:center"><a href="" class="btn btn-primary">Detail</a></td>
                        </tr>

                        <?php $total+=$data->jum_usulan; ?>
                    @endforeach
                </tbody>
                <tfoot>
                    <td colspan="2">Total</td>
                    <td style="text-align:right">{{getNumber($total)}}</td>
                    <td></td>
                </tfoot>
            </table>
            
            @endif
        </div>
    </div>
@stop

@section('script')    
    <script>
      $(function () {
        $('#rekapUsulan').DataTable({"pageLength": 10});
      });
    </script>
@endsection