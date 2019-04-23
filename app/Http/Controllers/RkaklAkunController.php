<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RkaklAkun as RkaklAkun;
use App\RkaklTahun as RkaklTahun;
use DB;
use Validator;

class RkaklAkunController extends Controller
{
	public function index($tahun) {
		$data_tahun 	= RkaklTahun::all();
		$tahun 			= $tahun;

		$data 	= DB::table('rkakl_akun')->where('tahun','=',$tahun)->get();

		return view('admin.dashboard.klasifikasi.akun',compact('data', 'tahun', 'data_tahun'));

	}

	public function addAkun(request $request) {
		$input 	= $request->all();
		$pesan 	= array(
			'kode_akun.max'=> 'Kode program maxsimal 6 karakter',
			'uraian_akun.required' => 'Uraian harus di isi'
		);

		$aturan = array(
			'kode_akun' => 'required|max:6',
			'uraian_akun'=>'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('akun/'.$request->tahun)
                        ->withErrors($validasi)
                        ->withInput();
		}
		
		$data = new RkaklAkun();
		$data->tahun 	= $request->tahun;
		$data->kode_akun	= $request->kode_akun;
		$data->uraian_akun 	= $request->uraian_akun;
		$data->sumber_dana	= $request->sumber_dana;
		$data->save();

		return Redirect('akun/'.$request->tahun);
	}

	public function editAkun(request $request) {
		$input 	= $request->all();
		$pesan 	= array(
			'kode_akun.max'=> 'Kode program maxsimal 6 karakter',
			'uraian_akun.required' => 'Uraian harus di isi'
		);

		$aturan = array(
			'kode_akun' => 'required|max:6',
			'uraian_akun'=>'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('akun/'.$request->tahun)
                        ->withErrors($validasi)
                        ->withInput();
		}
		
		$data = RkaklAkun::find($request->id_akun);
		$data->kode_akun	= $request->kode_akun;
		$data->uraian_akun 	= $request->uraian_akun;
		$data->sumber_dana	= $request->sumber_dana;
		$data->update();

		return Redirect('akun/'.$request->tahun);
	}

	public function hapusAkun(request $request, $id, $tahun)	{
		$data 	= DB::table('rkakl_akun')->WHERE('id_akun', '=' ,$id);
    	if($data == null) 
            app::abort(404);
        $data->delete();

    	return Redirect('akun/'.$tahun);
	}
}
