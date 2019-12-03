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
use App\TtdSpp as TtdSpp;
use App\RkaklTahun as Tahun;
use App\RkaklSubAlokasi as SubAlokasi;
use App\Telaah as Telaah;
use App\UsulanLampiran as Lampiran;
use App\UsulanBarang as Barang;
use App\MstBarang as MstBarang;
use App\Sp as Sp;

class SpController extends Controller
{
    public function step1($id){
        $tahun = Tahun::all();

        if($id!=0) {
            $tahunSp = Sp::select('tahun')->where('id_sp', '=', 'id');
        }
        
        return view('admin.dashboard.sp.step1Sp', compact('tahun', 'id', 'tahunSp'));
    }

    public function pilihTahun(request $request){
        $tahun = $request->tahun;

        return Redirect('spp/tambah/step2/'.$tahun.'/0')->with(getNotif('Berhasil pilih tahun anggaran', 'success'));
    }

    public function step2(request $request, $tahun, $id){
        $tahun = $request->tahun;
        $user   = Auth::User()->id;
        $subAlokasi     = SubAlokasi::where('tahun', '=', $tahun)->with('akun')->get();
        $telaah     = Telaah::join('usulan', 'telaah.id_usulan', '=', 'usulan.id_usulan')
            ->where('telaah.tgl_kirim', '!=', NULL)
            ->get();

        $ttdSP = TtdSpp::all();

        if($id != 0) {
            $sp    = Sp::where('id_sp', '=', $id)->with('sA', 'penandatangan', 'telaah')->first();
        }
        

        return view('admin.dashboard.sp.step2Sp', compact('tahun', 'user', 'subAlokasi', 'telaah', 'ttdSP', 'id', 'sp'));
    }

    public function loadUsulanTelaah($id){
        $telaah     = Telaah::join('usulan', 'telaah.id_usulan', '=', 'usulan.id_usulan')
            ->join('mst_unit_kerja', 'usulan.id_unit_kerja', '=', 'mst_unit_kerja.id_unit_kerja')
            ->join('usulan_barang', 'usulan_barang.id_usulan', '=', 'usulan.id_usulan')
            ->groupBy(
                'usulan.no_usulan',
                'usulan.tgl_usulan',
                'usulan.perihal_usulan',
                'usulan.isi_usulan',
                'mst_unit_kerja.nama_unit_kerja',
                'telaah.no_telaah',
                'telaah.tgl_telaah',
                'telaah.analisis_kebutuhan',
                'telaah.alasan_kebutuhan',
                'telaah.urgency'
            )
            ->select(
                'usulan.no_usulan',
                'usulan.tgl_usulan',
                'usulan.perihal_usulan',
                'usulan.isi_usulan',
                'mst_unit_kerja.nama_unit_kerja',
                'telaah.no_telaah',
                'telaah.tgl_telaah',
                'telaah.analisis_kebutuhan',
                'telaah.alasan_kebutuhan',
                'telaah.urgency',
                \DB::raw('sum(usulan_barang.jumlah_harga_telaah) as total_telaah'),
                \DB::raw('sum(usulan_barang.jumlah_usulan) as total_usulan')
            )
            ->where('telaah.id_telaah', '=', $id)
            ->where('telaah.tgl_kirim', '!=', NULL)
            ->first();

        return view('admin.dashboard.sp.loadUsulanTelaah', compact('telaah'));
    }

    public function simpanSp(request $request){
        if($request->id == 0) {
            $data = new Sp;
            $data->user_input = $request->user;
            $data->tahun    = $request->tahun;
            $data->id_telaah   = $request->telaah;
            $data->no_sp    = $request->nosp;
            $data->tgl_sp   = $request->tglsp;
            $data->hal_sp   = $request->halsp;
            $data->id_sub_alokasi   = $request->idalokasi;
            $data->penandatangan_sp = $request->penandatangan;
            $data->save();

            return Redirect('spp/tambah/step2/'.$request->tahun.'/'.$data->id_sp)->with(getNotif('Data berhasil di tambahkan', 'success'));

        } else {
            $data   = SP::find($request->id);
            $data->user_input = $request->user;
            $data->id_telaah   = $request->telaah;
            $data->no_sp    = $request->nosp;
            $data->tgl_sp   = $request->tglsp;
            $data->hal_sp   = $request->halsp;
            $data->id_sub_alokasi   = $request->idalokasi;
            $data->penandatangan_sp = $request->penandatangan;
            $data->update();

            return Redirect('spp/tambah/step2/'.$request->tahun.'/'.$data->id_sp)->with(getNotif('Data berhasil di Update', 'success'));
        }
    }

    public function step3($tahun, $id){
        $dataSp     = SP::find($id);
        $barangTelaah = Barang::join('telaah', 'telaah.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('telaah.id_telaah', '=', $dataSp->id_telaah)
            ->NotIN('usulan_barang.id_barang_usulan', '')
            ->get();

        return view('admin.dashboard.sp.step3Sp', compact('tahun', 'id', 'barangTelaah'));
    }
}
