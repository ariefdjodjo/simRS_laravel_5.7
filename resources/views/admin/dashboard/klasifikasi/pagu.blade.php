@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Pagu Alokasi</li>
          </ol>
@stop
@section('content')
    <div class="box box-primary">
        <div class="box-header">
        <div class="btn-group">
            @foreach($data_tahun as $th)
                <a href="{{{URL::to('pagu/'.$th->tahun)}}}" 
                    @if($tahun == $th->tahun)
                        class="btn btn-primary " 
                    @else 
                        class="btn btn-default " 
                    @endif
                    role="button">{{$th->tahun}}</a>
            @endforeach
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                <h3 class="box-title">Data Pagu Anggaran Tahun {{ $tahun }}</h3>
                </div><!-- /.box-header -->
                
                <div class="box-body">
    @if($tahun == 0) 
        Pilih Tahun 
    @else
    
        <table id="dataAkun" class="table table-bordered">
        <thead>
            <tr>
            <th width="5%">No</th>
            <th width="40%">Uraian Sub Alokasi</th>
            <th width="15%">Sumber Dana</th>
            <th width="20%">Pagu Alokasi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $urut=1; 
                $total = 0;
            ?>
            @foreach($data as $subAlokasi)
                <tr>
                    <td>{{{$urut++}}}</td>
                    <td>{{{$subAlokasi->uraian_sub_alokasi}}}</td>
                    <td>{{{$subAlokasi->sumber_dana}}}</td>
                    <td style="text-align:right;">{{{getNumber($subAlokasi->pagu_alokasi)}}}</td>
                </tr>
                <?php $total+= $subAlokasi->pagu_alokasi; ?>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align:right"><b>TOTAL PAGU ALOKASI</b></td>
                <td style="text-align:right"><b>{{getNumber($total)}}</b></td>
            </tr>
        </tfoot>
        </table>  
    @endif
                </div>
            </div>
        </div>
    </div>    
@endsection

@section('script')
	
    
    <script>
      $(function () {

        $('#dataAkun').DataTable({"pageLength": 10});

      });

    </script>

@endsection