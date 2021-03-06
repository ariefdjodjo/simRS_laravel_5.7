@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Data Draft Telaah</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Draft Telaah</li>
  </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <div class="btn-group">
                @foreach($th as $data)
                    <a href="{{{URL::to('telaah/draftTelaah/'.$data->tahun)}}}" 
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
    ?>
    <div class="box box-primary">
        <div class="box-header">
            <b><h3>Data Draft Telaah Belum Dikirim</h3></b>
        </div>
        <div class="box-body">
            @if($tahun==0)
            <h3>PILIH TAHUN</h3>
            @else
            
            <table class="table table-bordered" id="draftUsulan">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Nomor Telaah</th>
                        <th width="10%">Lampiran</th>
                        <th width="25%">Perihal Telaah</th>
                        <th width="15%">RAB Usulan</th>
                        <th width="15%">RAB Telaah</th>
                        <th width="10%">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($telaah as $data)
                        <tr>
                            <td>{{$urut++}}</td>
                            <td>{{$data->no_telaah}}</td>
                            <td>{{getTfi($data->tgl_telaah)}}</td>
                            <td>Telaah {{$data->perihal_usulan}}</td>
                            <td style="text-align:right">{{getNumber($data->jum_usulan)}}</td>
                            <td style="text-align:right">{{getNumber($data->jum_telaah)}}</td>

                            <td>
                                @if($data->tgl_kirim == NULL)
                                    <a href="{{url('telaah/tambahTelaah/'.$data->id_telaah.'/detailTelaah')}}" class="btn btn-primary btn-sm"><i class="fa fa-loop"></i> Detail</a>
                                @else 
                                    <a href="{{url('telaah/selesai/'.$data->id_telaah)}}" class="btn btn-primary btn-sm"><i class="fa fa-loop"></i> Detail</a>
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