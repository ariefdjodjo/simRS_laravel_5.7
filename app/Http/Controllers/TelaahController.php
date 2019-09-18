<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Validator;
use Storage;
use Mail;
use PDF;
use App\Usulan as Usulan;
use App\Mail\SentMail;
use App\TtdUsulan as TtdUsulan;
use App\TtdTelaah as TtdTelaah;
use App\RkaklTahun as Tahun;
use App\UsulanLampiran as Lampiran;
use App\UsulanBarang as Barang;
use App\MstBarang as MstBarang;

class TelaahController extends Controller
{
    protected function usulanMasuk($kriteria, $tahun){
        $id_unit = Auth::user()->id_unit_kerja;

        $th = Tahun::all();
        if($kriteria == "belum") {
            $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.tgl_kirim', '!=', NULL)
            ->where('usulan.dibaca', '=', NULL)
            ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as jum, usulan.no_usulan, usulan.tgl_usulan, usulan.perihal_usulan, usulan.id_usulan, usulan.dibaca'))
            ->groupBy('usulan_barang.id_usulan', 'usulan.no_usulan', 'usulan.tgl_usulan', 'usulan.perihal_usulan', 'usulan.id_usulan', 'usulan.dibaca')
            ->get();
        } elseif($kriteria == "belumProses") {
            $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.tgl_kirim', '!=', NULL)
            ->where('usulan.dibaca', '!=', NULL)
            ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as jum, usulan.no_usulan, usulan.tgl_usulan, usulan.perihal_usulan, usulan.id_usulan, usulan.dibaca'))
            ->groupBy('usulan_barang.id_usulan', 'usulan.no_usulan', 'usulan.tgl_usulan', 'usulan.perihal_usulan', 'usulan.id_usulan', 'usulan.dibaca')
            ->get();
        } elseif($kriteria == "Proses") {
            $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.tgl_kirim', '!=', NULL)
            ->where('usulan.dibaca', '!=', NULL)
            ->whereIn('usulan.id_usulan', DB::table('telaah')->select('telaah.id_usulan')->where('telaah.id_usulan', '=', 'usulan.id_usulan'))
            ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as jum, usulan.no_usulan, usulan.tgl_usulan, usulan.perihal_usulan, usulan.id_usulan, usulan.dibaca'))
            ->groupBy('usulan_barang.id_usulan', 'usulan.no_usulan', 'usulan.tgl_usulan', 'usulan.perihal_usulan', 'usulan.id_usulan', 'usulan.dibaca')
            ->get();
        }
        

        return view('admin.dashboard.telaah.usulanMasuk', compact('tahun', 'th', 'usulan'));
    }

    protected function baca($id) {
        $tgl = date('Y-m-d');
        $data = Usulan::find($id);
        $data->dibaca = $tgl;
        $data->update();

        return Redirect('telaah/detailUsulan/'.$id);
    }

    protected function detailUsulan($id){
        $id_unit = Auth::user()->id_unit_kerja;
        $usulan = Usulan::where('id_usulan', '=', $id)->first();
        $lampiran = DB::table('usulan_lampiran')->where('id_usulan', '=', $id)->get();
        $barang     = DB::table('usulan_barang')->where('id_usulan', '=', $id)->get();
        $jenis = $usulan->jenis_usulan;
        $mstBarang  = DB::table('ref_master_barang')->where('kode_jenis_barang', '=', $jenis)->get();

        return view('admin.dashboard.telaah.detailUsulan', compact('lampiran', 'barang', 'usulan', 'mstBarang', 'id_unit'));
    }

    public function pdfUsulan($id){
        $id_unit = Auth::user()->id_unit_kerja;

        $usulan     = DB::table('usulan')
            ->join('mst_unit_kerja', 'usulan.id_unit_kerja', '=', 'mst_unit_kerja.id_unit_kerja')
            ->join('ref_ttd_usulan', 'usulan.pengirim_usulan', '=', 'ref_ttd_usulan.id_ttd_usulan')
            ->where('usulan.id_usulan', '=', $id)->first();

        $lampiran = DB::table('usulan_lampiran')->where('id_usulan', '=', $id)->get();
        $barang     = DB::table('usulan_barang')->where('id_usulan', '=', $id)->get();
        $mstBarang  = DB::table('ref_master_barang')->where('kode_jenis_barang', '=', $usulan->jenis_usulan)->get();

        $pdf = PDF::loadview('admin.dashboard.telaah.pdfUsulan', compact('lampiran', 'barang', 'usulan', 'mstBarang'));
       
        return $pdf->stream();
    }

    protected function tambahTelaah($id) {
        $ttdTelaah  = TtdTelaah::all();
        $usulan = Usulan::find($id);
        return view('admin.dashboard.telaah.tambahTelaah', compact('tahun', 'ttdTelaah', 'usulan'));
    }
    
    public function loadUsulan($tahun) {
        $usulan= Usulan::where('tahun', '=', $tahun)->get();

        return response()->json($usulan);
        exit;
        //return view('admin.dashboard.telaah.loadUsulan', compact('usulan'));
    }
}
