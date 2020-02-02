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
            <div class="btn-group">
                @foreach($th as $data)
                    <a href="{{{URL::to('spp/data/'.$data->tahun)}}}" 
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
        $jum_barang = 0;
    ?>
    <div class="box box-primary">
        <div class="box-header">
            <b><h3>Data Usulan</h3></b>
        </div>
        <div class="box-body">
            @if($tahun==0)
            <h3>PILIH TAHUN</h3>
            @else
            
            <table class="table table-bordered" id="draftUsulan">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Nomor/Tanggal</th>
                        <th width="25%">Perihal SP</th>
                        <th width="5%">RAB</th>
                        <th width="15%">Sub Alokasi</th>
                        <th width="4%">SD</th>
                        <th width="4%">Status</th>
                        <th width="5%">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sp as $data)
                        <tr>
                            <td>{{$urut++}}</td>
                            <td>{{$data->no_sp}}<br>{{getTfi($data->tgl_sp)}}</td>
                            <td>{{$data->hal_sp}}</td>
                            <td style="text-align:right">
                                @foreach ($data->barangSp as $item)
                                    <?php 
                                        $harga = $item->qty_sp*$item->harga_satuan_sp;
                                        $jum_barang+=$harga; 
                                    ?>
                                @endforeach
                                {{getNumber($jum_barang)}}
                            </td>
                            <td>{{$data->sA->uraian_sub_alokasi}}</td>
                            <td>{{$data->sA->akun->sumber_dana}}</td>
                            <td>
                                @if ($data->status_sp == NULL)
                                    <small class="label bg-green">draft</small>
                                @elseif($data->status_sp == "Aktif")
                                    <small class="label bg-purple">Aktif</small>
                                @else
                                    <small class="label bg-maroon">Batal</small>
                                @endif
                            </td>
                            <td>
                                @if ($data->status_sp == NULL)
                                    <a href="{{url('spp/tambah/step4/'.$data->tahun.'/'.$data->id_sp.'')}}" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Detail</a>
                                @else 
                                    <a href="{{url('spp/tambah/step5/'.$data->tahun.'/'.$data->id_sp.'')}}" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Detail</a>
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