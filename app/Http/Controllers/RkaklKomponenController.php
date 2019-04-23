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


class RkaklKomponenController extends Controller
{
    public function __construct()
    {
        $this->middleware('level:4');
    }

    public function index($tahun, $keg, $output, $subOutput){
		$tahun          = RkaklTahun::find($tahun);
		$kegiatan 		= RkaklKegiatan::find($keg);
		$output 		= RkaklOutput::find($output);
		$data_subOutput 		= RkaklSubOutput::find($subOutput);

    	$data = RkaklKomponen::where('kode_komponen', 'like', $subOutput.'-%')
    		->get();

    	return view('admin.dashboard.klasifikasi.komponen',compact('data', 'tahun', 'kegiatan', 'output', 'data_subOutput'));
    }

    public function add() {

    }

    public function prosesAdd(request $request) {
		$input	= $request->all();
		$pesan 	= array(
			'kode_komponen.max' => 'Tidak boleh lebih dari 3 Karakter',
			'kode_komponen.required' => 'Tidak boleh kosong'
		);
		$aturan	= array(
			'kode_komponen' => 'required|max:3',
			'uraian_komponen' => 'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);
		
		if ($validasi->fails()) {
            return redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output)
                        ->withErrors($validasi)
                        ->withInput();
		}

    	$data = new RkaklKomponen();
    	$kode_komponen = $request->kode_sub_output."-".$request->kode_komponen;
    	$data->kode_komponen = $kode_komponen;
    	$data->uraian_komponen = $request->uraian_komponen;
    	$data->save();

    	return Redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output);
    }

    public function prosesEdit(request $request, $id) {
		$input	= $request->all();
		$pesan 	= array(
			'kode_komponen.max' => 'Tidak boleh lebih dari 3 Karakter',
			'kode_komponen.required' => 'Tidak boleh kosong'
		);
		$aturan	= array(
			'kode_komponen' => 'required|max:3',
			'uraian_komponen' => 'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);
		
		if ($validasi->fails()) {
            return redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output)
                        ->withErrors($validasi)
                        ->withInput();
		}

    	$data 	= RkaklKomponen::find($id);
    	$kode_komponen = $request->kode_sub_output."-".$request->kode_komponen;
    	$data->kode_komponen = $kode_komponen;
    	$data->uraian_komponen = $request->uraian_komponen;
    	$data->update();

    	return Redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output);
    }

    public function prosesHapus(request $request, $id) {
    	$data 	= RkaklKomponen::WHERE('id_komponen', '=' ,$id);
    	if($data == null) 
            app::abort(404);
		$data->delete();

    	return Redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output);
    }
}
