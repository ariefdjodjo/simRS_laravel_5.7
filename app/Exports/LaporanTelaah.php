<?php

namespace App\Exports;

use App\Telaah as Telaah;
use App\Usulan as Usulan;
use App\TtdUsulan as TtdUsulan;
use App\MstUnitKerja as UnitKerja;
use Auth;
use DB;

//use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class LaporanTelaah implements FromView
{
    use Exportable;

    public function __construct(string $tahun)
    {
        $this->tahun = $tahun;
    }

    public function view():view
    {
        $tahun = $this->tahun;

        $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->join('telaah', 'usulan.id_usulan', '=', 'telaah.id_usulan')
            ->where('telaah.tgl_kirim', '!=', NULL)
            ->where('usulan.tahun', '=', $tahun)
            ->select(DB::raw('usulan.perihal_usulan, telaah.no_telaah, telaah.tgl_telaah, telaah.urgency, usulan.tahun, telaah.tgl_kirim, sum(usulan_barang.jumlah_usulan) as jum_usulan, sum(usulan_barang.jumlah_harga_telaah) as jum_telaah'))
            ->groupBy( 'usulan.perihal_usulan', 'telaah.no_telaah', 'telaah.tgl_telaah', 'telaah.urgency', 'telaah.tgl_kirim', 'usulan.tahun')
            ->get();

        return view('admin.dashboard.laporan.exportLaporanTelaah', compact('usulan', 'tahun'));
    }
}
