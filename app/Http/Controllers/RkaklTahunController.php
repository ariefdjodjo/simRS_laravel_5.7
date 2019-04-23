<?php
/** Controller untuk Tahun Anggaran */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RkaklTahun as rkaklTahun;
use Validator;

class RkaklTahunController extends Controller
{
	public function __construct()
    {
        $this->middleware('level:4');
    }

    public function index(){
    	$data 	= rkaklTahun::orderBy('tahun','ASC')->get();
    	return view('admin.dashboard.klasifikasi.index',compact('data'));
    }

    public function add() {

    }

    public function prosesAdd(request $request) {
		$input 	= $request->all();
		$pesan 	= array(
			'tahun.unique' => 'Tahun sudah ada',
			'kode_program.max'=> 'Kode program maxsimal 30 karakter',
			'uraian_program.required' => 'Uraian harus di isi'
		);

		$aturan = array(
			'tahun' => 'required|unique:rkakl_tahun|max:5',
			'kode_program' => 'required|max:30',
			'uraian_program'=>'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('klasifikasi/')
                        ->withErrors($validasi)
                        ->withInput();
        }


    	$tahun = new RkaklTahun();
    	$tahun->tahun = $request->tahun;
    	$tahun->kode_program = $request->kode_program;
    	$tahun->uraian_program = $request->uraian_program;
		$tahun->save();
	
    	return Redirect('klasifikasi/');
    }

    public function prosesEdit(request $request, $id) {
		$input 	= $request->all();
		$pesan 	= array(
			'kode_program.max'=> 'Kode program maxsimal 30 karakter',
			'uraian_program.required' => 'Uraian harus di isi'
		);

		$aturan = array(
			'kode_program' => 'required|max:30',
			'uraian_program'=>'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('klasifikasi/')
                        ->withErrors($validasi)
                        ->withInput();
        }

    	$tahun 	= RkaklTahun::find($id);
    	$tahun->tahun = $request->tahun;
    	$tahun->kode_program = $request->kode_program;
    	$tahun->uraian_program = $request->uraian_program;
    	$tahun->update();

    	return Redirect('klasifikasi/');
    }

    public function prosesHapus(request $request, $id) {
    	$tahun 	= RkaklTahun::WHERE('tahun', '=' ,$id);
    	if($tahun == null) {
			return redirect('klasifikasi/');
		}
		$tahun->delete();
		
		

        return Redirect('klasifikasi/');
    }
}
