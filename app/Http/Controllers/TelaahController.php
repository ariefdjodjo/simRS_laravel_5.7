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
use App\RkaklTahun as Tahun;
use App\UsulanLampiran as Lampiran;
use App\UsulanBarang as Barang;
use App\MstBarang as MstBarang;

class TelaahController extends Controller
{
    protected function usulanMasuk($tahun){
        $id_unit = Auth::user()->id_unit_kerja;

        $th = Tahun::all();

        $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.id_unit_kerja', '=', $id_unit)
            ->where('usulan.tgl_kirim', '!=', NULL)
            ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as jum, usulan.no_usulan, usulan.tgl_usulan, usulan.perihal_usulan, usulan_barang.jumlah_usulan, usulan.id_usulan, usulan.dibaca'))
            ->groupBy('usulan_barang.id_usulan', 'usulan.no_usulan', 'usulan.tgl_usulan', 'usulan.perihal_usulan', 'usulan_barang.jumlah_usulan', 'usulan.id_usulan', 'usulan.dibaca')
            ->get();

        return view('admin.dashboard.telaah.usulanMasuk', compact('tahun', 'th', 'usulan'));
    }

    protected function baca($id) {
        $tgl = date('Y-m-d');
        $data = Usulan::find($id);
        $data->dibaca = $tgl;
        $data->update();

        return Redirect('detailUsulan/'.$id);
    }

    protected function detailUsulan($id){
        $id_unit = Auth::user()->id_unit_kerja;
        $usulan = Usulan::where('id_usulan', '=', $id)->where('id_unit_kerja', '=', $id_unit)->first();
        $lampiran = DB::table('usulan_lampiran')->where('id_usulan', '=', $id)->get();
        $barang     = DB::table('usulan_barang')->where('id_usulan', '=', $id)->get();
        $mstBarang  = DB::table('ref_master_barang')->where('kode_jenis_barang', '=', $usulan->jenis_usulan)->get();

        return view('admin.dashboard.telaah.detailUsulan', compact('lampiran', 'barang', 'usulan', 'mstBarang', 'id'));
    }

    protected function pdfUsulan($id){
        $id_unit = Auth::user()->id_unit_kerja;
        $usulan = Usulan::where('id_usulan', '=', $id)->where('id_unit_kerja', '=', $id_unit)->first();
        $lampiran = DB::table('usulan_lampiran')->where('id_usulan', '=', $id)->get();
        $barang     = DB::table('usulan_barang')->where('id_usulan', '=', $id)->get();
        $mstBarang  = DB::table('ref_master_barang')->where('kode_jenis_barang', '=', $usulan->jenis_usulan)->get();

        $pdf = PDF::loadview('admin.dashboard.telaah.pdfUsulan', compact('lampiran', 'barang', 'usulan', 'mstBarang'));

        return $pdf->stream();
    }
}
