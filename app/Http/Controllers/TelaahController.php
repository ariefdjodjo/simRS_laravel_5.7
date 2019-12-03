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
use App\Telaah as Telaah;
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

            $status = 0;
        } elseif($kriteria == "belumProses") {
            $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.tgl_kirim', '!=', NULL)
            ->where('usulan.dibaca', '!=', NULL)
            ->whereNotIn('usulan.id_usulan', function($query){
                $query->select('telaah.id_usulan')->from('telaah');   
            })
            ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as jum, usulan.no_usulan, usulan.tgl_usulan, usulan.perihal_usulan, usulan.id_usulan, usulan.dibaca'))
            ->groupBy('usulan_barang.id_usulan', 'usulan.no_usulan', 'usulan.tgl_usulan', 'usulan.perihal_usulan', 'usulan.id_usulan', 'usulan.dibaca')
            ->get();

            $status = 1;
        } elseif($kriteria == "Proses") {
            /* $telaah = array_keys(DB::table('telaah')->select('id_usulan')->get());
            $array=join(',', $telaah); */
            $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->join('telaah', 'usulan.id_usulan', '=', 'telaah.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.tgl_kirim', '!=', NULL)
            ->where('usulan.dibaca', '!=', NULL)
            ->whereIn('usulan.id_usulan', function($query){
                $query->select('telaah.id_usulan')->from('telaah');   
            })
            ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as jum, usulan.no_usulan, usulan.tgl_usulan, usulan.perihal_usulan, usulan.id_usulan, usulan.dibaca, telaah.tgl_kirim'))
            ->groupBy('usulan_barang.id_usulan', 'usulan.no_usulan', 'usulan.tgl_usulan', 'usulan.perihal_usulan', 'usulan.id_usulan', 'usulan.dibaca', 'telaah.tgl_kirim')
            ->get();
            
            $status = 2;
        }
        
        return view('admin.dashboard.telaah.usulanMasuk', compact('tahun', 'th', 'usulan', 'status'));
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

    protected function prosesTambahTelaah(request $request){

        if($request->analisis == NULL && $request->alasan == NULL) {
            return back()->with(getNotif('Data Gagal Disimpan', 'error'));
        } else {

            $data = new Telaah();
            $data->id_usulan    = $request->noUsulan;
            $data->no_telaah    = $request->noTelaah;
            $data->tgl_telaah   = $request->tglTelaah;
            $data->penandatangan    = $request->pengirim;
            $data->analisis_kebutuhan   = $request->analisis;
            $data->alasan_kebutuhan     = $request->alasan;
            $data->urgency      = $request->urgensi;
            $data->save();

            return Redirect('telaah/tambahTelaah/'.$data->id_telaah.'/detailTelaah')->with(getNotif('Data '.$data->no_telaah.' berhasil ditambahkan', 'success'));
        } 
    }

    public function prosesAnalisis($id){
        $tahun = date('Y');

        $barang = Barang::where('id_usulan', '=', $id)->get();

        try{
            foreach($barang as $item) {
                $data = Barang::find($item->id_barang_usulan);
                $harga = Barang::where('usulan_barang.id_usulan', '=', $id)
                    ->leftjoin('ref_master_barang', 'usulan_barang.nama_barang', '=', 'ref_master_barang.nama_barang')
                    ->leftjoin('ref_standart_biaya', 'ref_standart_biaya.id_master_barang', '=', 'ref_master_barang.id_master_barang')
                    ->select('ref_standart_biaya.harga_satuan')
                    ->where('ref_standart_biaya.tahun', '=', $tahun)
                    ->where('usulan_barang.id_barang_usulan', '=', $data->id_barang_usulan)
                    ->first();
                $data->harga_telaah = $harga->harga_satuan;
                $data->update();
            }
            return Redirect('telaah/tambahTelaah/'.$data->id_usulan.'/analisisHarga')->with(getNotif('Data '.$data->no_telaah.' berhasil dilakukan analisis harga', 'success'));
        } catch(Exception $e) {
            return back()->with(getNotif('Gagal', "Gagal dalam Menganalisis Harga Barang")); 
        }   
    }

    public function analisisHarga($id) {
        $barang = Barang::where('usulan_barang.id_usulan', '=', $id)
            ->leftjoin('ref_master_barang', 'usulan_barang.nama_barang', '=', 'ref_master_barang.nama_barang')
            ->leftjoin('ref_standart_biaya', 'ref_standart_biaya.id_master_barang', '=', 'ref_master_barang.id_master_barang')
            ->where('ref_standart_biaya.tahun', '=', '2019')
            ->get();

        $harga = 0;
        $qty = 0;

        foreach($barang as $item) {
            $harga+=$item->harga_telaah;
            $qty+=$item->qty_telaah;
        }
        //return response()->json($harga);
        return view('admin.dashboard.telaah.analisisHarga', compact('barang', 'id', 'harga', 'qty'));
    }

    public function detailTelaah($id){
        $data = DB::table('telaah')
            ->where('telaah.id_usulan', '=', $id)
            ->first();

        $usulan = DB::table('usulan')
            ->join('mst_unit_kerja', 'usulan.id_unit_kerja', '=', 'mst_unit_kerja.id_unit_kerja')
            ->join('ref_ttd_usulan', 'usulan.pengirim_usulan', '=', 'ref_ttd_usulan.id_ttd_usulan')
            ->where('id_usulan', '=', $id)
            ->first();

        $barang = DB::table('usulan_barang')
        ->where('id_usulan', '=', $id)
        ->get();

        $ttdTelaah  = TtdTelaah::all();

        $harga = 0;
        $qty = 0;

        foreach($barang as $item) {
            $harga+=$item->harga_telaah;
            $qty+=$item->qty_telaah;
        }

        return view('admin.dashboard.telaah.detailTelaah', compact('data', 'barang', 'id', 'harga', 'qty', 'usulan', 'ttdTelaah'));
    }
    
    public function loadUsulan($tahun) {
        $usulan= Usulan::where('tahun', '=', $tahun)->get();

        return response()->json($usulan);
        exit;
        //return view('admin.dashboard.telaah.loadUsulan', compact('usulan'));
    }

    protected function prosesUbah(request $request, $idBarang, $idUsulan) {
        try{
            $data = Barang::find($request->id_barang);
            $data->harga_telaah = $request->harga_telaah;
            $data->update();

            return back()->with(getNotif('Data berhasil di ubah', 'success'));
        } catch(Exception $e) {
            return back()->with(getNotif("Gagal dalam Menganalisis Harga Barang", 'error')); 
        }   
    }

    public function analisisKebutuhan($id){
        $barang = Barang::where('usulan_barang.id_usulan', '=', $id)
            ->leftjoin('ref_master_barang', 'usulan_barang.nama_barang', '=', 'ref_master_barang.nama_barang')
            ->leftjoin('ref_standart_biaya', 'ref_standart_biaya.id_master_barang', '=', 'ref_master_barang.id_master_barang')
            ->where('ref_standart_biaya.tahun', '=', '2019')
            ->get();

        $harga = 0;
        $qty = 0;

        foreach($barang as $item) {
            $harga+=$item->harga_telaah;
            $qty+=$item->qty_telaah;
        }

        return view('admin.dashboard.telaah.analisisKebutuhan', compact('barang', 'id', 'harga', 'qty'));
    }

    protected function prosesUpdateKebutuhan(request $request){
        $id_Barang = $request->id_barang;

        $jum_harga = $request->qty_telaah*$request->harga;

        if($request->qty_telaah == 0 || $request->qty_telaah == NULL ){
            $status = 0;
        } else {
            $status = 1;
        }
        
        try{
            $data = Barang::find($id_Barang);
            $data->qty_telaah = $request->qty_telaah;
            $data->jumlah_harga_telaah = $jum_harga;
            $data->catatan_kebutuhan = $request->catatan_kebutuhan;
            $data->status_barang_telaah = $status;
            $data->update();

            return back()->with(getNotif('Data berhasil di ubah', 'success'));
        } catch(Exception $e) {
            return back()->with(getNotif("Gagal dalam Update Kebutuhan Barang", 'error')); 
        }   
    }

    public function telaahSelesai($id) {
        $data = DB::table('telaah')
        ->join('usulan', 'telaah.id_usulan', '=', 'usulan.id_usulan')
        ->join('mst_unit_kerja', 'usulan.id_unit_kerja', '=', 'mst_unit_kerja.id_unit_kerja')
        ->join('ref_ttd_usulan', 'usulan.pengirim_usulan', '=', 'ref_ttd_usulan.id_ttd_usulan')
        ->join('ref_ttd_telaah', 'telaah.penandatangan', '=', 'ref_ttd_telaah.id_ttd_telaah')
        ->where('telaah.id_usulan', '=', $id)
        ->first();

        $barang = DB::table('usulan_barang')
        ->where('id_usulan', '=', $id)
        ->get();

        $harga = 0;
        $qty = 0;
        $total = 0;

        foreach($barang as $item) {
            $harga+=$item->harga_telaah;
            $qty+=$item->qty_telaah;
            $jumlah=$item->harga_telaah*$item->qty_telaah;
            $total+=$jumlah;
        }

        return view('admin.dashboard.telaah.telaahSelesai', compact('data', 'barang', 'id', 'harga', 'qty', 'total', 'jumlah'));
    }

    public function kirimTelaah($id) {
        $datanya = DB::table('telaah')
            ->join('usulan', 'telaah.id_usulan', '=', 'usulan.id_usulan')
            ->join('mst_unit_kerja', 'usulan.id_unit_kerja', '=', 'mst_unit_kerja.id_unit_kerja')
            ->join('ref_ttd_usulan', 'usulan.pengirim_usulan', '=', 'ref_ttd_usulan.id_ttd_usulan')
            ->join('ref_ttd_telaah', 'telaah.penandatangan', '=', 'ref_ttd_telaah.id_ttd_telaah')
            ->where('telaah.id_usulan', '=', $id)
            ->first();

        $tujuanSp = DB::table('ref_email')->where('level_user', '=', 4)->first();
        
        $data = array(
            'tujuan' => $tujuanSp->alamat_email,
            'feedback' => $datanya->email_unit_kerja,
            'perihal' => $datanya->perihal_usulan,
            'no_telaah' => $datanya->no_telaah
        );

        try{
            Mail::send('admin.dashboard.telaah.mail', $data, function($message) use ($data) {
                $message->to($data['tujuan'])->cc($data['feedback'])->subject('Telaah Pengadaan No.'.$data['no_telaah']);
                $message->from('anggaran.sardjito@gmail.com','Sistem Monev Anggaran');
            });
        } catch(Exception $e) {
            return back()->with('Gagal', "terima kasih"); 
        }

        $tgl = date('Y-m-d');

        $id_telaah = $datanya->id_telaah;

        $update = Telaah::find($id_telaah);
        $update->tgl_kirim = $tgl;
        $update->update();

        return redirect('telaah/selesai/'.$id)->with(getNotif('Data berhasil di dikirimkan', 'success')); 
    }

    public function pdfTelaah($id) {
        $data = DB::table('telaah')
        ->join('usulan', 'telaah.id_usulan', '=', 'usulan.id_usulan')
        ->join('mst_unit_kerja', 'usulan.id_unit_kerja', '=', 'mst_unit_kerja.id_unit_kerja')
        ->join('ref_ttd_usulan', 'usulan.pengirim_usulan', '=', 'ref_ttd_usulan.id_ttd_usulan')
        ->join('ref_ttd_telaah', 'telaah.penandatangan', '=', 'ref_ttd_telaah.id_ttd_telaah')
        ->where('telaah.id_usulan', '=', $id)
        ->first();

        $barang = DB::table('usulan_barang')
        ->where('id_usulan', '=', $id)
        ->get();

        $harga = 0;
        $qty = 0;
        $total = 0;

        foreach($barang as $item) {
            $harga+=$item->harga_telaah;
            $qty+=$item->qty_telaah;
            $jumlah=$item->harga_telaah*$item->qty_telaah;
            $total+=$jumlah;
        }

        $pdf = PDF::loadview('admin.dashboard.telaah.pdfTelaah', compact('data', 'barang', 'id', 'harga', 'qty', 'total', 'jumlah'));

        return $pdf->stream();
    }

    public function rekapUsulan($tahun){
        $th      = Tahun::all();
        
        $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->join('telaah', 'usulan.id_usulan', '=', 'telaah.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.tgl_kirim', '!=', NULL)
            ->where('telaah.tgl_kirim', '!=', NULL)
            ->select(DB::raw('usulan.jenis_usulan, sum(usulan_barang.jumlah_usulan) as jum_usulan, sum(usulan_barang.jumlah_harga_telaah) as jum_telaah, usulan.jenis_usulan'))
            ->groupBy( 'usulan.jenis_usulan')
            ->get();

        return view('admin.dashboard.telaah.rekapUsulanTelaah',compact('tahun', 'th', 'data_jenis', 'usulan','detail'));
    }

    public function rekapUsulanJenis($tahun, $jenis){ 
        $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->join('telaah', 'usulan.id_usulan', '=', 'telaah.id_usulan')
            ->where('telaah.tgl_kirim', '!=', NULL)
            ->where('usulan.jenis_usulan', '=', $jenis)
            ->select(DB::raw('usulan.perihal_usulan, telaah.no_telaah, telaah.tgl_telaah, sum(usulan_barang.jumlah_usulan) as jum_usulan, sum(usulan_barang.jumlah_harga_telaah) as jum_telaah'))
            ->groupBy( 'usulan.perihal_usulan', 'telaah.no_telaah', 'telaah.tgl_telaah')
            ->get();

        return view('admin.dashboard.telaah.rekapUsulanTelaahJenis',compact('tahun', 'data_jenis', 'usulan','detail', 'jenis'));
    }

    public function draftTelaah($tahun) {
        $th      = Tahun::all();

        $telaah = DB::table('telaah')
            ->leftJoin('usulan', 'usulan.id_usulan', '=', 'telaah.id_usulan')
            ->leftJoin('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('telaah.tgl_kirim', '=', NULL)
            ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as jum_usulan, sum(usulan_barang.jumlah_harga_telaah) as jum_telaah, telaah.no_telaah, telaah.id_usulan, telaah.tgl_telaah, usulan.perihal_usulan, telaah.tgl_kirim'))
            ->groupBy( 'telaah.id_usulan', 'telaah.no_telaah', 'telaah.tgl_telaah', 'usulan.perihal_usulan', 'telaah.tgl_kirim')
            ->get();

        return view('admin.dashboard.telaah.draftTelaahData',compact('tahun', 'th', 'data_jenis', 'telaah','detail'));
    }

    public function daftarTelaah($tahun) {
        $th      = Tahun::all();
        $level   = Auth::user()->level;

        $telaah = DB::table('telaah')
            ->leftJoin('usulan', 'usulan.id_usulan', '=', 'telaah.id_usulan')
            ->leftJoin('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('telaah.tgl_kirim', '!=', NULL)
            ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as jum_usulan, sum(usulan_barang.jumlah_harga_telaah) as jum_telaah, telaah.no_telaah, telaah.id_usulan, telaah.tgl_telaah, usulan.perihal_usulan, telaah.tgl_kirim'))
            ->groupBy( 'telaah.id_usulan', 'telaah.no_telaah', 'telaah.tgl_telaah', 'usulan.perihal_usulan', 'telaah.tgl_kirim')
            ->get();

        return view('admin.dashboard.telaah.daftarTelaah',compact('tahun', 'th', 'data_jenis', 'telaah','detail', 'level'));
    }

    public function editTelaah(request $request, $id) {
        $data = Telaah::find($id);
        $data->no_telaah    = $request->noTelaah;
        $data->tgl_telaah   = $request->tglTelaah;
        $data->analisis_kebutuhan = $request->analisis;
        $data->alasan_kebutuhan = $request->alasan;
        $data->urgency = $request->urgensi;
        $data->penandatangan = $request->pengirim;
        $data->update();

        return back()->with(getNotif('Data berhasil di simpan', 'success')); 
    }

}
