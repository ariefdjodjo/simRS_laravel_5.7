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
        <div style="text-align:right; padding:5px">
            <a href="{{url('Laporan/'.$tahun)}}" class="btn btn-primary btn-sm">Struktur RKA-K/L</a>
        </div>   
          
          <div class="box-body">
              <table class="table table-bordered tree" id="tree">
                  <thead>
                      <tr>
                          <th style="text-align:center" width="15%">Kode</th>
                          <th style="text-align:center" width="50%">Uraian Kegiatan/Output/Sub Output/Komponen/Sub Komponen/Akun</th>
                          <th style="text-align:center" width="5%">SD</th>
                          <th style="text-align:center" width="15%">Pagu Alokasi</th>
                      </tr>
                  </thead>
                  <tbody>
                        @foreach ($kegiatan as $keg)
                        <tr style="font-size:1.3em; font-weight: bold; color:blue" class="treegrid-{{$keg->id_kegiatan}} expanded">
                            <td style="text-align:center">{{getKegiatan($keg->kode_kegiatan)}}</td>
                            <td>{{$keg->uraian_kegiatan}}</td>
                            <td></td>
                            <td style="text-align:right">{{getNumber($keg->pg_kegiatan)}}</td>
                        </tr>
                        
                        @foreach ($output[$keg->id_kegiatan] as $a)
                            <tr style="font-size:1.1em; font-weight: bold;" class="treegrid-{{$keg->id_kegiatan}}{{$a->id_output}} treegrid-parent-{{$keg->id_kegiatan}} expanded">
                                <td style="text-align:center">{{getKegiatan($keg->kode_kegiatan)}}.{{getKode($a->kode_output)}}</td>
                                <td>{{$a->uraian_output}}</td>
                                <td></td>
                                <td style="text-align:right">{{getNumber($a->total)}}</td>
                            </tr>

                            @foreach ($subOutput[$a->id_output] as $so)
                                <tr class="treegrid-{{$keg->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}} treegrid-parent-{{$keg->id_kegiatan}}{{$a->id_output}} expanded">
                                    <td style="text-align:center">{{getKegiatan($keg->kode_kegiatan)}}.{{getKode($a->kode_output)}}.{{getKode($so->kode_sub_output)}}</td>
                                    <td>{{$so->uraian_sub_output}}</td>
                                    <td></td>
                                    <td style="text-align:right">{{getNumber($so->total)}}</td>
                                </tr>

                                @foreach ($komponen[$so->id_sub_output] as $kom)
                                    <tr style="font-size:1.1em; font-weight: bold; font-style:italic"  class="treegrid-{{$keg->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}}{{$kom->id_komponen}} treegrid-parent-{{$keg->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}} expanded">
                                        <td style="text-align:center">{{getKode($kom->kode_komponen)}}</td>
                                        <td>{{$kom->uraian_komponen}}</td>
                                        <td></td>
                                        <td style="text-align:right">{{getNumber($kom->total)}}</td>
                                    </tr>

                                    @foreach ($subKomponen[$kom->id_komponen] as $sKom)
                                        <tr  class="treegrid-{{$keg->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}}{{$kom->id_komponen}}{{$sKom->id_sub_komponen}} treegrid-parent-{{$keg->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}}{{$kom->id_komponen}} expanded">
                                            <td style="text-align:center">{{getKode($sKom->kode_sub_komponen)}}</td>
                                            <td>{{$sKom->uraian_sub_komponen}}</td>
                                            <td></td>
                                            <td style="text-align:right">{{getNumber($sKom->total)}}</td>
                                        </tr>

                                        @foreach ($sAlokasi[$sKom->id_sub_komponen] as $sA)
                                            <tr  class="treegrid-{{$keg->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}}{{$kom->id_komponen}}{{$sKom->id_sub_komponen}}{{$sA->id_sub_alokasi}} treegrid-parent-{{$keg->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}}{{$kom->id_komponen}}{{$sKom->id_sub_komponen}} expanded">
                                                <td style="text-align:center">{{$sA->kode_akun}}</td>
                                                <td>{{$sA->uraian_sub_alokasi}}</td>
                                                <td>{{$sA->sumber_dana}}</td>
                                                <td style="text-align:right">{{getNumber($sA->total)}}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                    
                            @endforeach
                        @endforeach
                        
                    @endforeach
                    {{-- @endfor     --}}
                  </tbody>
              </table>

    @endif
</div>
</div>
</div>
@endsection

@section('script')

<script type="text/javascript">
        $(document).ready(function() {
        $('.tree').treegrid();
    });
</script>

@endsection
