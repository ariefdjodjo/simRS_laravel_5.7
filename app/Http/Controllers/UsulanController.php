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
use App\Email as Email;
use App\Exports\LaporanUsulan;


class UsulanController extends Controller {
    public $kode;

    /* fungsi index */
    public function index(){

    }

    public function tambah() {
        $id_user = Auth::user()->id;
        
        $id_unit = Auth::user()->id_unit_kerja;
        
        $tahun   = Tahun::all();

        $satker     = UnitKerja::find($id_unit);
        
        $pengirim = TtdUsulan::where('id_unit_kerja', '=', $id_unit)->get();


        return view('admin.dashboard.usulan.formUsulan1',compact('id_user', 'pengirim', 'tahun', 'satker'));
    }

    public function edit($id) { 
        $id_user = Auth::user()->id;
        
        $id_unit = Auth::user()->id_unit_kerja;
        
        $tahun      = Tahun::all();
       
        $pengirim = TtdUsulan::where('id_unit_kerja', '=', $id_unit)->get();
        
        $usulan = Usulan::join('ref_ttd_usulan', 'ref_ttd_usulan.id_ttd_usulan', '=', 'usulan.pengirim_usulan')
            ->where('usulan.id_usulan', '=', $id)
            ->where('usulan.id_unit_kerja', '=', $id_unit)
            ->first();

        return view('admin.dashboard.usulan.editUsulan', compact('id_user', 'pengirim', 'tahun', 'usulan', 'id'));
    }

    public function prosesTambah(request $request){ 
        $input 	= $request->all();
        
        $pesan 	= array(
            'file.mimes' => 'File dalam format .PDF , .xlsx, .xls, .doc, .docx',
            'file.max' => 'Maksimal 10 MB'
		);

		$aturan = array(
            'file' => 'mimes:pdf,xlsx,xls,doc,docx', 
            'file' => 'max:10000'
		);

		$validasi = Validator::make($input, $aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('tambahUsulan/')
                ->withErrors($validasi)
                ->withInput();
        }

        $id_user = Auth::user()->id;
        $id_unit = Auth::user()->id_unit_kerja;
        $data = new Usulan();
        $data->id = $id_user;
        $data->tahun            = $request->tahun;
        $data->id_unit_kerja    = $id_unit;
        $data->no_usulan        = $request->no_usulan;
        $data->tgl_usulan       = $request->tgl_usulan;
        $data->perihal_usulan   = $request->perihal;
        $data->jenis_usulan     = $request->jenis_usulan;
        $data->isi_usulan       = $request->isi;
        $data->pengirim_usulan  = $request->pengirim;
        $data->save();

        return Redirect('tambahItemBarang/'.$data->id_usulan)->with(getNotif('Data berhasil di Tambahkan', 'success'));
    }

    public function prosesEdit(request $request, $id) {
        $input 	= $request->all();
		$pesan 	= array(
            
		);

		$aturan = array(
            
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('editUsulan/'.$id)
                ->withErrors($validasi)
                ->withInput();
        }

        $data = Usulan::find($id);
        $data->no_usulan        = $request->no_usulan;
        $data->tgl_usulan       = $request->tgl_usulan;
        $data->perihal_usulan   = $request->perihal;
        $data->jenis_usulan     = $request->jenis_usulan;
        $data->isi_usulan       = $request->isi;
        $data->pengirim_usulan  = $request->pengirim;
        $data->update();

        return Redirect('tambahItemBarang/'.$id)->with(getNotif('Data berhasil di Update', 'success'));
    }

    public function uploadLampiran(request $request, $id) {
        $input 	= $request->all();
		$pesan 	= array(
            'file.mimes' => 'File dalam format .PDF , .xlsx, .xls, .doc, .docx',
            'file.max' => 'Maksimal 10 MB'
		);

		$aturan = array(
            'file' => 'mimes:pdf,xlsx,xls,doc,docx', 
            'file' => 'max:10000'
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('tambahItemBarang/'.$id)
                ->withErrors($validasi)
                ->withInput();
        }
        
        $file = $request->file;
        $name = 'Usulan-'.$id.'_'.$file->getClientOriginalName();
        $path = $file->storeAs('public/usulan/', $name);

        $data = new Lampiran();
        $data->id_usulan    = $id;
        $data->nama_dokumen = $file->getClientOriginalName();
        $data->link_file    = $name;
        $data->save();

        return Redirect('tambahItemBarang/'.$id)->with(getNotif('file berhasil di upload', 'success'));
    }

    public function hapusLampiran($id, $idFile){
        $file = Lampiran::find($idFile);
        $oldFile = $file->link_file;
        Storage::delete('public/usulan/'.$oldFile);
        
        $data = DB::table('usulan_lampiran')->where('id_lampiran_usulan', '=', $idFile);
        if($data == null) 
            app::abort(404);
        $data->delete();

        return Redirect('tambahItemBarang/'.$id)->with(getNotif('Data berhasil di hapus', 'error'));
    }

    public function tambahBarang(request $request, $id) {
        $input 	= $request->all();
		$pesan 	= array(
            
		);

		$aturan = array(
            
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('tambahItemBarang/'.$id)
                ->withErrors($validasi)
                ->withInput();
        }
        $jumlah     = $request->harga * $request->kebutuhan;
        if($request->nama_barang  == ""){
            $nama = $request->namaBarang;
        } else {
            $nama       = $request->nama_barang;
        }
        
        $data = new Barang();
        $data->id_usulan    = $id;
        $data->nama_barang  = $nama;
        $data->spesifikasi  = $request->spesifikasi;
        $data->satuan       = $request->satuan;
        $data->qty_usulan   = $request->kebutuhan;
        $data->harga_usulan = $request->harga;
        $data->jumlah_usulan    = $jumlah;
        $data->catatan_usulan   = $request->catatan;
        $data->save();

        return Redirect('tambahItemBarang/'.$id)->with(getNotif('Data berhasil di ditambahkan', 'success'));
    }

    public function editBarang(request $request,$id, $id_usulan) {
        $input 	= $request->all();
		$pesan 	= array(
            
		);

		$aturan = array(
            
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('tambahItemBarang/'.$id)
                ->withErrors($validasi)
                ->withInput();
        }
        $jumlah     = $request->harga * $request->kebutuhan;

        $data = Barang::find($id);
        $data->nama_barang  = $request->nama_barang;
        $data->spesifikasi  = $request->spesifikasi;
        $data->satuan       = $request->satuan;
        $data->qty_usulan   = $request->kebutuhan;
        $data->harga_usulan = $request->harga;
        $data->jumlah_usulan    = $jumlah;
        $data->catatan_usulan   = $request->catatan;
        $data->Update();

        return Redirect('tambahItemBarang/'.$id_usulan)->with(getNotif('Data berhasil di Update', 'success'));
    }

    public function hapusBarang($idBarang, $idUsulan){
        $data = DB::table('usulan_barang')
            ->where('id_barang_usulan', '=', $idBarang)
            ->where('id_usulan', '=', $idUsulan);
        if($data == null) 
            app::abort(404);
        $data->delete();

        return Redirect('tambahItemBarang/'.$idUsulan)->with(getNotif('Data berhasil di hapus', 'error'));
    }

    public function addItem($id){
        $id_unit = Auth::user()->id_unit_kerja;

        $usulan = Usulan::where('id_usulan', '=', $id)->where('id_unit_kerja', '=', $id_unit)->first();

        $lampiran = DB::table('usulan_lampiran')->where('id_usulan', '=', $id)->get();

        $barang     = DB::table('usulan_barang')->where('id_usulan', '=', $id)->get();

        $mstBarang  = DB::table('ref_master_barang')
            ->select('id_master_barang','nama_barang')
            ->where('kode_jenis_barang', '=', $usulan->jenis_usulan)
            ->whereNotIn('nama_barang', DB::table('usulan_barang')->pluck('nama_barang'))
            ->get();
        
        return view('admin.dashboard.usulan.formUsulan2',compact('usulan','lampiran', 'barang', 'mstBarang'));
    }

    public function loadBarang($id_barang) {
        $mstBarang = MstBarang::find($id_barang);

        return response()->json([
            'kode' => $mstBarang->id_master_barang,
            'nama' => $mstBarang->nama_barang,
            'spesifikasi' => $mstBarang->spesifikasi,
            'satuanBarang' => "<option value='".$mstBarang->satuan."' selected>".$mstBarang->satuan."</option>",
        ]);
    }

    public function draftUsulan($tahun) {
        $id_unit = Auth::user()->id_unit_kerja;

        $th = Tahun::all();
       /*  $usulan = Usulan::where('usulan.tahun', '=', $tahun)->get(); */
        $usulan = DB::table('usulan')
            ->leftJoin('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as jum, usulan.no_usulan, usulan.tgl_usulan, usulan.perihal_usulan, usulan.id_usulan'))
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.id_unit_kerja', '=', $id_unit)
            ->where('usulan.tgl_kirim', '=', NULL)
            ->groupBy('usulan.id_usulan', 'usulan.no_usulan', 'usulan.tgl_usulan', 'usulan.perihal_usulan', 'usulan_barang.id_usulan')
            ->get();

        return view('admin.dashboard.usulan.draftUsulan',compact('tahun', 'th', 'usulan'));
    }

    protected function detail($id){
        $id_unit = Auth::user()->id_unit_kerja;
        $level      = Auth::user()->level;
        if($level == 4) {
            $usulan = Usulan::where('id_usulan', '=', $id)->first();
        } else {
            $usulan = Usulan::where('id_usulan', '=', $id)->where('id_unit_kerja', '=', $id_unit)->first();
        }

        $lampiran = DB::table('usulan_lampiran')->where('id_usulan', '=', $id)->get();

        $barang     = DB::table('usulan_barang')->where('id_usulan', '=', $id)->get();

        $mstBarang  = DB::table('ref_master_barang')->where('kode_jenis_barang', '=', $usulan->jenis_usulan)->get();
        
        return view('admin.dashboard.usulan.detailUsulan',compact('usulan','lampiran', 'barang', 'mstBarang'));

    }

    public function kirim($id){
        $barang = Barang::where('id_usulan', '=', $id)->count();
        $str = exec("ping -c 1 www.google.com");
        if($str != 0) {
            return back()->with(getNotif('Koneksi Gagal', 'error'));
        } else {

        

        if($barang == 0) {
            return back()->with(getNotif('Item barang usulan belum di isi', 'error'));
        } else {
            $datanya    = DB::table('usulan')
                ->join('mst_unit_kerja', 'usulan.id_unit_kerja', '=', 'mst_unit_kerja.id_unit_kerja')
                ->where('usulan.id_usulan', '=', $id)->first();
            $tujuannya = DB::table('ref_email')->where('level_user', '=', 3)->first();

            $data = array(
                'tujuan' => $tujuannya->alamat_email,
                'no_usulan' => $datanya->no_usulan,
                'perihal' => $datanya->perihal_usulan,
                'pengirim' => $datanya->nama_unit_kerja,
                'tgl_usulan' => $datanya->tgl_usulan
            );

            try{
                Mail::send('admin.dashboard.usulan.mail', $data, function($message) use ($data) {
                    $message->to($data['tujuan'])->subject('Usulan Pengadaan No.'.$data['no_usulan']);
                    $message->from('anggaran.sardjito@gmail.com','Sistem Monev Anggaran');
                });
            } catch(Exception $e) {
                return back()->with('Gagal', "terima kasih"); 
            }
            
            $tgl = date('Y-m-d');

            $update = Usulan::find($id);
            $update->tgl_kirim = $tgl;
            $update->update();

            return back()->with(getNotif('Data berhasil di dikirimkan', 'success')); 
        }
    }
    }
    
    protected function dataUsulan($tahun){
        $id_unit = Auth::user()->id_unit_kerja;

        $th = Tahun::all();

        $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.id_unit_kerja', '=', $id_unit)
            ->where('usulan.tgl_kirim', '!=', NULL)
            ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as jum, usulan.no_usulan, usulan.tgl_usulan, usulan.perihal_usulan, usulan.id_usulan'))
            ->groupBy('usulan_barang.id_usulan', 'usulan.no_usulan', 'usulan.tgl_usulan', 'usulan.perihal_usulan', 'usulan.id_usulan')
            ->get();

        return view('admin.dashboard.usulan.dataUsulan',compact('tahun', 'th', 'usulan','detail'));
    }

    protected function rekap($tahun){
        $id_unit = Auth::user()->id_unit_kerja;
        $th      = Tahun::all();
        
        $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.id_unit_kerja', '=', $id_unit)
            ->where('usulan.tgl_kirim', '!=', NULL)
            ->select(DB::raw('usulan.jenis_usulan, sum(usulan_barang.jumlah_usulan) as jum_usulan, count(usulan.id_usulan) as countUsulan'))
            ->groupBy( 'usulan.jenis_usulan')
            ->get();

        return view('admin.dashboard.usulan.rekapUsulan',compact('tahun', 'th', 'data_jenis', 'usulan','detail'));
    }

    protected function pdfRekap($tahun){
        $id_unit = Auth::user()->id_unit_kerja;
        $satker  = UnitKerja::find($id_unit);
        $th      = Tahun::all();
        
        $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.id_unit_kerja', '=', $id_unit)
            ->where('usulan.tgl_kirim', '!=', NULL)
            ->select(DB::raw('usulan.jenis_usulan, sum(usulan_barang.jumlah_usulan) as jum_usulan, usulan.jenis_usulan'))
            ->groupBy( 'usulan.jenis_usulan')
            ->get();

        $pdf = PDF::loadview('admin.dashboard.usulan.pdfRekapUsulan', compact('tahun', 'th', 'usulan', 'satker'));
        return $pdf->stream();
    }

    public function excelRekap($tahun){
        $tgl = date('dmY_h');
        return (new LaporanUsulan($tahun))->download($tgl.'_TA'.$tahun.'__Laporan_Usulan.xlsx');
    }

    protected function rekapDetail($tahun, $jenis) {
        $id_unit = Auth::user()->id_unit_kerja;
        $th      = Tahun::all();

        $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.id_unit_kerja', '=', $id_unit)
            ->where('usulan.tgl_kirim', '!=', NULL)
            ->where('usulan.jenis_usulan', '=', $jenis)
            ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as jum, usulan.no_usulan, usulan.tgl_usulan, usulan.perihal_usulan, usulan.id_usulan'))
            ->groupBy('usulan_barang.id_usulan', 'usulan.no_usulan', 'usulan.tgl_usulan', 'usulan.perihal_usulan', 'usulan.id_usulan')
            ->get();

        return view('admin.dashboard.usulan.rekapDetailUsulan',compact('tahun', 'th', 'usulan', 'jenis'));
    }

    protected function pdfRekapDetail($tahun, $jenis) {
        $id_unit = Auth::user()->id_unit_kerja;
        $satker  = UnitKerja::find($id_unit);
        $th      = Tahun::all();

        $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.id_unit_kerja', '=', $id_unit)
            ->where('usulan.tgl_kirim', '!=', NULL)
            ->where('usulan.jenis_usulan', '=', $jenis)
            ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as jum, usulan.no_usulan, usulan.tgl_usulan, usulan.perihal_usulan, usulan.id_usulan'))
            ->groupBy('usulan_barang.id_usulan', 'usulan.no_usulan', 'usulan.tgl_usulan', 'usulan.perihal_usulan', 'usulan.id_usulan')
            ->get();
        
        $pdf = PDF::loadview('admin.dashboard.usulan.pdfRekapDetailUsulan', compact('tahun', 'th', 'usulan', 'satker'));
        return $pdf->stream();
    }

    protected function dataUsulanSpp($tahun){
        $th = Tahun::all();

        $usulan = DB::table('usulan')
            ->join('usulan_barang', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('usulan.tahun', '=', $tahun)
            ->where('usulan.tgl_kirim', '!=', NULL)
            ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as jum, usulan.no_usulan, usulan.tgl_usulan, usulan.perihal_usulan, usulan.id_usulan'))
            ->groupBy('usulan_barang.id_usulan', 'usulan.no_usulan', 'usulan.tgl_usulan', 'usulan.perihal_usulan', 'usulan.id_usulan')
            ->get();

        return view('admin.dashboard.sp.dataUsulan',compact('tahun', 'th', 'usulan','detail'));
    }
}
