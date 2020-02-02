@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Data Usulan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Usulan</li>
  </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <div class="btn-group" role="group">
                @foreach($th as $data)                
                <div class="btn-group">
                    <button type="button" 
                        <?php 
                        if($tahun == $data->tahun) {
                            echo "class='btn btn-primary dropdown-toggle'"; 
                        } else {
                            echo "class='btn btn-default dropdown-toggle'";
                        } 
                        ?>
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{$data->tahun}} <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('telaah/usulanMasuk/belum/'.$data->tahun)}}">Usulan Baru</a></li>
                        <li><a href="{{url('telaah/usulanMasuk/belumProses/'.$data->tahun)}}">Usulan Belum Proses</a></li>
                        <li><a href="{{url('telaah/usulanMasuk/Proses/'.$data->tahun)}}">Usulan Sudah di Proses</a></li>
                    </ul>
                </div>
                
                @endforeach
            </div>
        </div>
    </div>

    <?php 
        $urut   = 1;
    ?>
    <div class="box box-primary">
        <div class="box-header">
            <b>
                <h3>
                Data Usulan 
                @if ($kriteria=='belum')
                    Belum Dibaca
                @elseif($kriteria=='belumProses')
                    Belum Proses Telaah
                @else 
                    Sudah Diproses Telaah
                @endif
                <br>
                Tahun {{$tahun}}
                </h3>

            </b>
        </div>
        <div class="box-body">
            @if($tahun==0)
            <h3>PILIH TAHUN</h3>
            @else
            
            
            <table class="table table-bordered" id="draftUsulan">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Nomor Usulan</th>
                        <th width="10%">Lampiran</th>
                        <th width="25%">Perihal Usulan</th>
                        <th width="10%">RAB</th>
                        <th width="15%">#</th>
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
                            <td style="text-align:center">
                                @if($status == 0)
                                    <a href="{{url('telaah/baca/'.$data->id_usulan.'')}}" class="btn btn-primary btn-sm"><i class="fa fa-loop"></i> Baca</a>
                                @elseif($status == 1)
                                    <a href="{{url('telaah/detailUsulan/'.$data->id_usulan.'')}}" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Detail</a>
                                    <a href="{{url('telaah/tambahTelaah/'.$data->id_usulan.'')}}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> Buat Telaah</a>
                                @else 
                                    <a href="{{url('telaah/detailUsulan/'.$data->id_usulan.'')}}" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Detail</a>
                                    @if($data->tgl_kirim == NULL)
                                    <a href="{{url('telaah/tambahTelaah/'.$data->id_telaah.'/detailTelaah')}}" class="btn btn-success btn-sm"><i class="fa fa-book"></i> Detail Telaah</a>
                                    @else 
                                    <a href="{{url('telaah/selesai/'.$data->id_usulan)}}" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> Cetak Telaah</a>
                                    @endif
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            @endif
        </div>
    </div>
@stop

@section('script')    
    <script>
      $(function () {
        $('#draftUsulan').DataTable({"pageLength": 10});
      });
    </script>
@endsection