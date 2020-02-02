<?php

namespace App\Exports;

use App\Usulan as Usulan;
use App\TtdUsulan as TtdUsulan;
use App\MstUnitKerja as UnitKerja;
use Auth;
use DB;

//use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class LaporanUsulan implements FromView{
    use Exportable;

    public function __construct(string $tahun)
    {
        $this->tahun = $tahun;
    }

    public function view():view
    {
        $id_unit = Auth::user()->id_unit_kerja;
        $tahun = $this->tahun;
        $satker  = UnitKerja::find($id_unit);
        $usulan = DB::table('usulan')
        ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
        ->join('ref_ttd_usulan', 'usulan.pengirim_usulan', '=', 'ref_ttd_usulan.id_ttd_usulan')
        ->where('usulan.tahun', '=', $tahun)
        ->where('usulan.id_unit_kerja', '=', $id_unit)
        ->where('usulan.tgl_kirim', '!=', NULL)
        ->select('usulan.*', DB::raw('usulan.id_usulan, sum(usulan_barang.jumlah_usulan) as jum_usulan'), 'ref_ttd_usulan.nama_kepala')
        ->groupBy( 'usulan.id_usulan', 'usulan.tahun', 'usulan.id', 'usulan.id_unit_kerja', 'usulan.no_usulan', 'usulan.tgl_usulan', 'usulan.perihal_usulan', 'usulan.jenis_usulan', 'usulan.isi_usulan', 'usulan.pengirim_usulan', 'usulan.tgl_kirim', 'usulan.dibaca', 'usulan.created_at', 'usulan.updated_at', 'ref_ttd_usulan.nama_kepala')
        ->get();

        return view('admin.dashboard.laporan.exportLaporanUsulan', compact('tahun', 'usulan', 'satker'));
    }
}
