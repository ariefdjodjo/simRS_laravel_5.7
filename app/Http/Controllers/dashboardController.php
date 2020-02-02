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
use App\MstUnitKerja as UnitKerja;
use App\UsulanLampiran as Lampiran;
use App\UsulanBarang as Barang;
use App\MstBarang as MstBarang;
use App\Telaah as Telaah;
use App\Sp as Sp;
use App\Email as Email;

class dashboardController extends Controller
{
    public function halamanAwal(){
        $user = Auth::user();
        $tahun  = date('Y');
        if($user->level === 2) {
            $usulan     = Usulan::where('tahun', '=', $tahun)
                ->where('id_unit_kerja', '=', $user->id_unit_kerja)
                ->count('id_usulan'); 

            $grafik     = Usulan::select(DB::raw("sum(jenis_usulan = '5201') as cetakan, 
            sum(jenis_usulan = '5202') as atk, 
            sum(jenis_usulan = '5203') as brt"), 'tahun')
                ->groupBy('tahun')
                ->get();
        } else {
            $usulan     = Usulan::where('tahun', '=', $tahun)
                ->whereNotNull('tgl_kirim')
                ->count('id_usulan'); 

            $telaah     = Telaah::join('usulan', 'usulan.id_usulan', '=', 'telaah.id_usulan')
                ->where('usulan.tahun', '=', $tahun)
                ->whereNotNull('telaah.tgl_kirim')
                ->count('telaah.id_telaah'); 
            
            $sp     = Sp::where('tahun', '=', $tahun)
                ->whereNotNull('tgl_kirim_sp')
                ->where('status_sp', '=', 'Aktif')
                ->count('sp.id_sp'); 
        }

        return response()->json($grafik);
        // return view('admin.dashboard.index.mainmanajemen',compact('usulan','telaah', 'sp', 'tahun'));
    }

    public function pencarian($jenis, $id) {
        $tahun = Tahun::all();
        return view('admin.dashboard.laporan.pencarian',compact('usulan','telaah', 'sp', 'tahun'));
    }

    public function loadPencarian($id) {
        $usulan = Usulan::select('id_usulan', 'no_usulan', 'perihal_usulan')
        ->where('tahun', '=', $id)->get();

        $option = array();

        foreach ($usulan as $a) {
            $option += array($a->id_usulan => $a->no_usulan);
        }
        return response()->json($option);
    }

    public function prosesCari(request $request) {
        $nomor = $request->nomor;
        $tahun = $request->tahun;
        $cari = Usulan::where('tahun', '=', $request->tahun)
            ->where('no_usulan', 'like', "%".$nomor."%")
            ->first();

        if($cari == "") {

        } else {
            $barang     = Barang::where('id_usulan', '=', $cari->id_usulan)
            ->select(DB::raw('sum(jumlah_usulan) as jumUsulan, sum(jumlah_harga_telaah) as jumTelaah, sum(harga_telaah) as harga, sum(qty_telaah) as qty'))
            ->groupBy('id_usulan')
            ->first();

            $telaah = Telaah::where('telaah.id_usulan', '=', $cari->id_usulan)->first();
            if($telaah != "") {
                $sp     = Sp::where('id_telaah', '=', $telaah->id_telaah)->first();
            }
            
        }
        
        
        // return response()->json($cari);
        return view('admin.dashboard.laporan.hasilPencarianGuest', compact('cari', 'nomor', 'tahun', 'barang', 'telaah', 'sp'));
    }

    public function telusurUsulan($id){
        $cari = Usulan::where('id_usulan', '=', $id)
            ->first();

        if($cari == "") {

        } else {
            $barang     = Barang::where('id_usulan', '=', $cari->id_usulan)
            ->select(DB::raw('sum(jumlah_usulan) as jumUsulan, sum(jumlah_harga_telaah) as jumTelaah, sum(harga_telaah) as harga, sum(qty_telaah) as qty'))
            ->groupBy('id_usulan')
            ->first();

            $telaah = Telaah::where('telaah.id_usulan', '=', $cari->id_usulan)->first();
            if($telaah != ""){
                $sp     = Sp::where('id_telaah', '=', $telaah->id_telaah)->first();
            }
            
        }
        
        
        // return response()->json($cari);
        return view('admin.dashboard.laporan.hasilPencarian', compact('cari', 'nomor', 'tahun', 'barang', 'telaah', 'sp'));
    }
}
