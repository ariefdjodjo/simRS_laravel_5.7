@extends('admin.layout.master')
@section('breadcrump')
  <h1>
    Dashboard
    <small>Laporan Penerbitan SPP</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Laporan SPP</li>
  </ol>
@stop

@section('content')
    <?php 
        $urut   = 1;
        $jum_barang = 0;
    ?>
    @if($tahun == 0)
    <div class="box box-primary">
        <div class="box-header">
            <b><h3>Rekap Penerbitan SP Anggaran</h3></b>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%" style="text-align:center">NO.</th>
                        <th width="10%" style="text-align:center">TAHUN</th>
                        <th width="20%" style="text-align:center">PAGU ALOKASI</th>
                        <th width="20%" style="text-align:center">PENYERAPAN SP</th>
                        <th width="10%" style="text-align:center">%</th>
                        <th width="10%" style="text-align:center">SP TERBIT</th>
                        <th width="10%" style="text-align:center">DRAFT SP</th>
                        <th width="10%" style="text-align:center">SP BATAL</th>
                        <th width="10%" style="text-align:center">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekap as $th)
                        <tr>
                            <td>{{$urut++}}</td>
                            <td>{{$th->tahun}}</td>
                            <td style="text-align:right">{{getNumber($th->pagu)}}</td>
                            <td style="text-align:right">
                                @if ($serapan[$th->tahun] == "")
                                    {{getNumber($serapan[$th->tahun])}}
                                @else 
                                    {{getNumber($serapan[$th->tahun]->penyerapan)}}
                                @endif
                            </td>
                            <td style="text-align:center">
                                <?php $persen = ($serapan[$th->tahun]->penyerapan/$th->pagu)*100; ?>
                                {{getNumber($persen)}} %
                            </td>
                            <td style="text-align:right">
                                {{getNumberTanpaKoma($aktif[$th->tahun])}}
                            </td>
                            <td style="text-align:right">
                                {{getNumberTanpaKoma($draft[$th->tahun])}}
                            </td>
                            <td style="text-align:right">
                                {{getNumberTanpaKoma($batal[$th->tahun])}}
                            </td>
                            <td style="text-align:center">
                                <?php $level = Auth::user()->level; ?>
                                @if ($level===4)
                                    <a href="{{url('spp/laporan/'.$th->tahun)}}" class="btn btn-sm btn-primary"><i class="fa fa-bars"></i> Detail</a>
                                @else 
                                    <a href="{{url('manajemen/laporan/'.$th->tahun)}}" class="btn btn-sm btn-primary"><i class="fa fa-bars"></i> Detail</a>
                                @endif
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
        <div class="box box-primary">
            <div class="box-header">
                <b>
                    <h3>Rekap Penerbitan SP Anggaran</h3>
                    <h3>Tahun {{$tahun}}</h3>
                </b>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="10%" style="text-align:center">KODE</th>
                            <th width="25%" style="text-align:center">URAIAN</th>
                            <th width="5%" style="text-align:center">SD</th>
                            <th width="15%" style="text-align:center">PAGU ALOKASI</th>
                            <th width="15%" style="text-align:center">PENYERAPAN SP</th>
                            <th width="10%" style="text-align:center">SP TERBIT</th>
                            <th width="10%" style="text-align:center">DRAFT SP</th>
                            <th width="10%" style="text-align:center">SP BATAL</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr style="font-size:1.3em; font-weight: bold; color:blue" class="treegrid-{{$kegiatan->id_kegiatan}} expanded">
                                <td style="text-align:center">{{getKegiatan($kegiatan->kode_kegiatan)}}</td>
                                <td>{{$kegiatan->uraian_kegiatan}}</td>
                                <td></td>
                                <td style="text-align:right">{{getNumber($kegiatan->pg_kegiatan)}}</td>
                                <td style="text-align:right">
                                    @if ($serapanKeg == "")
                                        {{getNumber($serapanKeg)}}
                                    @else 
                                        {{getNumber($serapanKeg->penyerapan)}}
                                    @endif
                                    
                                </td>
                                <td style="text-align:right">
                                    {{getNumberTanpaKoma($aktifKeg)}}
                                </td>
                                <td style="text-align:right">
                                    {{getNumberTanpaKoma($draftKeg)}}
                                </td>
                                <td style="text-align:right">
                                    {{getNumberTanpaKoma($batalKeg)}}
                                </td>
                            </tr>
                            @foreach ($output as $a)
                                

                            <tr style="font-size:1.1em; font-weight: bold;" class="treegrid-{{$kegiatan->id_kegiatan}}{{$a->id_output}} treegrid-parent-{{$kegiatan->id_kegiatan}} expanded">
                                <td style="text-align:center">{{getKegiatan($kegiatan->kode_kegiatan)}}.{{getKode($a->kode_output)}}</td>
                                <td>{{$a->uraian_output}}</td>
                                <td></td>
                                <td style="text-align:right">{{getNumber($a->total)}}</td>
                                <td style="text-align:right">
                                        @if ($serapanOut[$a->id_output] == "")
                                            {{getNumber($serapanOut[$a->id_output])}}
                                        @else 
                                            {{getNumber($serapanOut[$a->id_output]->penyerapan)}}
                                        @endif
                                    </td>
                                    <td style="text-align:right">
                                        {{getNumberTanpaKoma($aktifOut[$a->id_output])}}
                                    </td>
                                    <td style="text-align:right">
                                        {{getNumberTanpaKoma($draftOut[$a->id_output])}}
                                    </td>
                                    <td style="text-align:right">
                                        {{getNumberTanpaKoma($batalOut[$a->id_output])}}
                                    </td>
                            </tr>
    
                                @foreach ($subOutput[$a->id_output] as $so)
                                    <tr class="treegrid-{{$kegiatan->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}} treegrid-parent-{{$kegiatan->id_kegiatan}}{{$a->id_output}} expanded">
                                        <td style="text-align:center">{{getKegiatan($kegiatan->kode_kegiatan)}}.{{getKode($a->kode_output)}}.{{getKode($so->kode_sub_output)}}</td>
                                        <td>{{$so->uraian_sub_output}}</td>
                                        <td></td>
                                        <td style="text-align:right">{{getNumber($so->total)}}</td>
                                        <td style="text-align:right">
                                            @if ($serapanSubOut[$so->id_sub_output] == "")
                                                {{getNumber($serapanSubOut[$so->id_sub_output])}}
                                            @else 
                                                {{getNumber($serapanSubOut[$so->id_sub_output]->penyerapan)}}
                                            @endif
                                        </td>
                                        <td style="text-align:right">
                                            {{getNumberTanpaKoma($aktifSubOut[$so->id_sub_output])}}
                                        </td>
                                        <td style="text-align:right">
                                            {{getNumberTanpaKoma($draftSubOut[$so->id_sub_output])}}
                                        </td>
                                        <td style="text-align:right">
                                            {{getNumberTanpaKoma($batalSubOut[$so->id_sub_output])}}
                                        </td>
                                    </tr>
    
                                    @foreach ($komponen[$so->id_sub_output] as $kom)
                                        <tr style="font-size:1.1em; font-weight: bold; font-style:italic"  class="treegrid-{{$kegiatan->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}}{{$kom->id_komponen}} treegrid-parent-{{$kegiatan->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}} expanded">
                                            <td style="text-align:center">{{getKode($kom->kode_komponen)}}</td>
                                            <td>{{$kom->uraian_komponen}}</td>
                                            <td></td>
                                            <td style="text-align:right">{{getNumber($kom->total)}}</td>
                                            <td style="text-align:right">
                                                @if ($serapanKomp[$kom->id_komponen] == "")
                                                    {{getNumber($serapanKomp[$kom->id_komponen])}}
                                                @else 
                                                    {{getNumber($serapanKomp[$kom->id_komponen]->penyerapan)}}
                                                @endif
                                            </td>
                                            <td style="text-align:right">
                                                {{getNumberTanpaKoma($aktifKomp[$kom->id_komponen])}}
                                            </td>
                                            <td style="text-align:right">
                                                {{getNumberTanpaKoma($draftKomp[$kom->id_komponen])}}
                                            </td>
                                            <td style="text-align:right">
                                                {{getNumberTanpaKoma($batalKomp[$kom->id_komponen])}}
                                            </td>
                                        </tr>
    
                                        @foreach ($subKomponen[$kom->id_komponen] as $sKom)
                                            <tr  class="treegrid-{{$kegiatan->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}}{{$kom->id_komponen}}{{$sKom->id_sub_komponen}} treegrid-parent-{{$kegiatan->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}}{{$kom->id_komponen}} expanded">
                                                <td style="text-align:center">{{getKode($sKom->kode_sub_komponen)}}</td>
                                                <td>{{$sKom->uraian_sub_komponen}}</td>
                                                <td></td>
                                                <td style="text-align:right">{{getNumber($sKom->total)}}</td>
                                                <td style="text-align:right">
                                                @if ($serapanSubKomp[$sKom->id_sub_komponen] == "")
                                                    {{getNumber($serapanSubKomp[$sKom->id_sub_komponen])}}
                                                @else 
                                                    {{getNumber($serapanSubKomp[$sKom->id_sub_komponen]->penyerapan)}}
                                                @endif
                                            </td>
                                            <td style="text-align:right">
                                                {{getNumberTanpaKoma($aktifSubKomp[$sKom->id_sub_komponen])}}
                                            </td>
                                            <td style="text-align:right">
                                                {{getNumberTanpaKoma($draftSubKomp[$sKom->id_sub_komponen])}}
                                            </td>
                                            <td style="text-align:right">
                                                {{getNumberTanpaKoma($batalSubKomp[$sKom->id_sub_komponen])}}
                                            </td>
                                            </tr>
    
                                            @foreach ($sAlokasi[$sKom->id_sub_komponen] as $sA)
                                                <tr  class="treegrid-{{$kegiatan->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}}{{$kom->id_komponen}}{{$sKom->id_sub_komponen}}{{$sA->id_sub_alokasi}} treegrid-parent-{{$kegiatan->id_kegiatan}}{{$a->id_output}}{{$so->id_sub_output}}{{$kom->id_komponen}}{{$sKom->id_sub_komponen}} expanded">
                                                    <td style="text-align:center">{{$sA->kode_akun}}</td>
                                                    <td>{{$sA->uraian_sub_alokasi}}</td>
                                                    <td>{{$sA->sumber_dana}}</td>
                                                    <td style="text-align:right">{{getNumber($sA->total)}}</td>
                                                    <td style="text-align:right">
                                                            @if ($serapanAkun[$sA->id_akun] == "")
                                                                {{getNumber($serapanAkun[$sA->id_akun])}}
                                                            @else 
                                                                {{getNumber($serapanAkun[$sA->id_akun]->penyerapan)}}
                                                            @endif
                                                        </td>
                                                        <td style="text-align:right">
                                                            {{getNumberTanpaKoma($aktifAkun[$sA->id_akun])}}
                                                        </td>
                                                        <td style="text-align:right">
                                                            {{getNumberTanpaKoma($draftAkun[$sA->id_akun])}}
                                                        </td>
                                                        <td style="text-align:right">
                                                            {{getNumberTanpaKoma($batalAkun[$sA->id_akun])}}
                                                        </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        {{-- @endfor     --}}
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@stop

@section('script')    
    <script>
      $(function () {
        $('#draftUsulan').DataTable({"pageLength": 10});
      });
    </script>
@endsection


    
