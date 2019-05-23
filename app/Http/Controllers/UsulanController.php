<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Validator;
use Storage;
use App\Usulan as Usulan;
use App\TtdUsulan as TtdUsulan;
use App\RkaklTahun as Tahun;
use App\UsulanLampiran as Lampiran;


class UsulanController extends Controller
{
    public function index(){

    }

    public function tambah() {
        $id_user = Auth::user()->id;
        $id_unit = Auth::user()->id_unit_kerja;
        $tahun      = Tahun::all();
        $pengirim = TtdUsulan::where('id_unit_kerja', '=', $id_unit)->get();
        return view('admin.dashboard.usulan.formUsulan1',compact('id_user', 'pengirim', 'tahun'));
    }

    public function prosesTambah(request $request) {
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

        return Redirect('tambahItemBarang/'.$data->id_usulan);
    }

    public function uploadLampiran(request $request, $id) {
        
    }

    public function addItem($id){
        $id_unit = Auth::user()->id_unit_kerja;

        $usulan = Usulan::where('id_usulan', '=', $id)->where('id_unit_kerja', '=', $id_unit)->first();
        
        return view('admin.dashboard.usulan.formUsulan2',compact('usulan'));
    }

    public function draftUsulan($tahun) {
        $th = Tahun::all();
        return view('admin.dashboard.usulan.draftUsulan',compact('tahun', 'th'));
    }
}
