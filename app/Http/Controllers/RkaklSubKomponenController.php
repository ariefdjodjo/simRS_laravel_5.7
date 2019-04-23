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

class RkaklSubKomponenController extends Controller
{
    public function __construct()
    {
        $this->middleware('level:4');
    }

    public function index($tahun, $keg, $output, $subOutput, $komponen){
    	$tahun          = RkaklTahun::find($tahun);
        $kegiatan 		= RkaklKegiatan::find($keg);
		$output 		= RkaklOutput::find($output);
		$data_subOutput = RkaklSubOutput::find($subOutput);
        $data_komponen 	= RkaklKomponen::find($komponen);

    	$data = RkaklSubKomponen::where('kode_sub_komponen', 'like', $komponen.'-%')
    		->get();

    	return view('admin.dashboard.klasifikasi.subKomponen',compact('data', 'tahun', 'kegiatan', 'output', 'data_subOutput', 'data_komponen'));
    }

    public function add() {

    }

    public function prosesAdd(request $request) {
		$input	= $request->all();
		$pesan 	= array(
			'kode_sub_komponen.max' => 'Tidak boleh lebih dari 3 Karakter',
			'kode_sub_komponen.required' => 'Tidak boleh kosong'
		);
		$aturan	= array(
			'kode_sub_komponen' => 'required|max:3',
			'uraian_sub_komponen' => 'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);
		
		if ($validasi->fails()) {
            return redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output.'/'.$request->kode_komponen)
                        ->withErrors($validasi)
                        ->withInput();
		}

    	$data = new RkaklSubKomponen();
    	$kode_sub_komponen = $request->kode_komponen."-".$request->kode_sub_komponen;
    	$data->kode_sub_komponen = $kode_sub_komponen;
    	$data->uraian_sub_komponen = $request->uraian_sub_komponen;
    	$data->save();

    	return redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output.'/'.$request->kode_komponen);
    }

    public function prosesEdit(request $request, $id) {
		$input	= $request->all();
		$pesan 	= array(
			'kode_sub_komponen.max' => 'Tidak boleh lebih dari 3 Karakter',
			'kode_sub_komponen.required' => 'Tidak boleh kosong'
		);
		$aturan	= array(
			'kode_sub_komponen' => 'required|max:3',
			'uraian_sub_komponen' => 'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);
		
		if ($validasi->fails()) {
            return redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output.'/'.$request->kode_komponen)
                        ->withErrors($validasi)
                        ->withInput();
		}

    	$data 	= RkaklSubKomponen::find($id);
    	$kode_sub_komponen = $request->kode_komponen."-".$request->kode_sub_komponen;
    	$data->kode_sub_komponen = $kode_sub_komponen;
    	$data->uraian_sub_komponen = $request->uraian_sub_komponen;
    	$data->update();

    	return redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output.'/'.$request->kode_komponen);
    }

    public function prosesHapus(request $request, $id) {
    	$data 	= RkaklSubKomponen::WHERE('id_sub_komponen', '=' ,$id);
    	if($data == null) 
            app::abort(404);
		$data->delete();

    	return redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output.'/'.$request->kode_komponen);
    }
}
