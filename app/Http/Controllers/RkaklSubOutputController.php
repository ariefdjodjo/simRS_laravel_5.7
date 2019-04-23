<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RkaklTahun as RkaklTahun;
use App\RkaklKegiatan as RkaklKegiatan;
use App\RkaklOutput as RkaklOutput;
use App\RkaklSubOutput as RkaklSubOutput;
use App\RkaklKomponen as RkaklKomponen;
use App\RkaklSubKomponen as RkaklSubKomponen;
use DB;
use Validator;

class RkaklSubOutputController extends Controller
{
    public function __construct()
    {
        $this->middleware('level:4');
    }

    public function index($tahun, $keg, $output){
		$th = RkaklTahun::find($tahun);
		$kegiatan = RkaklKegiatan::find($keg);
		$data_output 	= RkaklOutput::find($output);

    	$data = RkaklSubOutput::where('kode_sub_output', 'like', $output.'-%')->get();


    	return view('admin.dashboard.klasifikasi.subOutput',compact('data','th','kegiatan','data_output'));
    }

    public function prosesAdd(request $request) {
		$input	= $request->all();
		$pesan 	= array(
			'kode_sub_output.max' => 'Tidak boleh lebih dari 3 Karakter',
			'kode_sub_output.required' => 'Tidak boleh kosong'
		);
		$aturan	= array(
			'kode_sub_output' => 'required|max:3',
			'uraian_sub_output' => 'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);
		
		if ($validasi->fails()) {
            return redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output)
                        ->withErrors($validasi)
                        ->withInput();
		}
		
    	$data = new RkaklSubOutput();
    	$kode_sub_output = $request->kode_output."-".$request->kode_sub_output;
    	$data->kode_sub_output = $kode_sub_output;
    	$data->uraian_sub_output = $request->uraian_sub_output;
    	$data->save();

    	return Redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output);
    }

    public function prosesEdit(request $request, $id) {
		$input	= $request->all();
		$pesan 	= array(
			'kode_sub_output.max' => 'Tidak boleh lebih dari 3 Karakter',
			'kode_sub_output.required' => 'Tidak boleh kosong'
		);
		$aturan	= array(
			'kode_sub_output' => 'required|max:3',
			'uraian_sub_output' => 'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output)
                        ->withErrors($validasi)
                        ->withInput();
		}
		
    	$data 	= RkaklSubOutput::find($id);
    	$kode_sub_output = $request->kode_output."-".$request->kode_sub_output;
    	$data->kode_sub_output = $kode_sub_output;
    	$data->uraian_sub_output = $request->uraian_sub_output;
    	$data->update();

    	return Redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output);
    }

    public function prosesHapus(request $request, $id) {
    	$data 	= RkaklSubOutput::WHERE('id_sub_output', '=' ,$id);
    	if($data == null) 
            app::abort(404);
        $data->delete();

    	return Redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output);
    }
}
