<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RkaklKegiatan as RkaklKegiatan;
use Validator;

class RkaklKegiatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('level:4');
    }

    public function index($tahun){
    	$id_tahun = $tahun;
    	$data 	= RkaklKegiatan::where('tahun', 'like', $id_tahun)->get();
    	
    	return view('admin.dashboard.klasifikasi.kegiatan',compact('data', 'id_tahun'));
    }

    public function add() {

    }

    public function prosesAdd(request $request) {
		$input 	= $request->all();
		$pesan 	= array(
			'kode_kegiatan.max'=> 'Kode program maxsimal 10 karakter',
			'uraian_kegiatan.required' => 'Uraian harus di isi'
		);

		$aturan = array(
			'kode_kegiatan' => 'required|max:4',
			'uraian_kegiatan'=>'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('klasifikasi/'.$request->tahun)
                        ->withErrors($validasi)
                        ->withInput();
        }

    	$data = new RkaklKegiatan();
    	$kode_keg = $request->tahun."-".$request->kode_kegiatan;
    	$data->tahun = $request->tahun;
    	$data->kode_kegiatan = $kode_keg;
    	$data->uraian_kegiatan = $request->uraian_kegiatan;
    	$data->save();

    	return Redirect('klasifikasi/'.$data->tahun);
    }

    public function prosesEdit(request $request, $id) {
		$input 	= $request->all();
		$pesan 	= array(
			'kode_kegiatan.max'=> 'Kode program maxsimal 4 karakter',
		);

		$aturan = array(
			'kode_kegiatan' => 'required|max:4',
			'uraian_kegiatan'=>'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('klasifikasi/'.$request->tahun)
                        ->withErrors($validasi)
                        ->withInput();
		}
		
    	$data 	= RkaklKegiatan::find($id);
    	$kode_keg = $data->tahun."-".$request->kode_kegiatan;
    	$data->kode_kegiatan = $kode_keg;
    	$data->uraian_kegiatan = $request->uraian_kegiatan;
    	$data->update();

    	return Redirect('klasifikasi/'.$data->tahun);
    }

    public function prosesHapus(request $request, $tahun, $id) {
    	$data 	= RkaklKegiatan::WHERE('id_kegiatan', '=' ,$id);
    	if($data == null) 
            app::abort(404);
        $data->delete();

    	return Redirect('klasifikasi/'.$tahun);
    }
}
