<?php
/** Controler data output */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RkaklKegiatan as RkaklKegiatan;
use App\RkaklOutput as RkaklOutput;
use App\RkaklSubOutput as RkaklSubOutput;
use Validate;
use DB;

/** membuat class */
class RkaklOutputController extends Controller
{
    public function __construct()
    {
        $this->middleware('level:4');
    }

    public function index($tahun, $keg){
		$kegiatan 	= RkaklKegiatan::find($keg);
		$tahun 		= $tahun;

    	$data = RkaklOutput::where('kode_output', 'like', $keg.'-%')
    		->get();

    	return view('admin.dashboard.klasifikasi.output',compact('data', 'tahun', 'kegiatan'));
    }

    public function add() {

    }

    public function prosesAdd(request $request) {
    	$data = new RkaklOutput();
    	$kode_output = $request->id_kegiatan."-".$request->kode_output;
    	$data->kode_output = $kode_output;
    	$data->uraian_output = $request->uraian_output;
    	$data->save();

    	return Redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan);
    }

    public function prosesEdit(request $request, $id) {
    	$data 	= RkaklOutput::find($id);
    	$kode_output = $request->id_kegiatan."-".$request->kode_output;
    	$data->kode_output = $kode_output;
    	$data->uraian_output = $request->uraian_output;
    	$data->update();

    	return Redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan);
    }

    public function prosesHapus(request $request, $id) {
    	$data 	= RkaklOutput::WHERE('id_output', '=' ,$id);
    	if($data == null) 
            app::abort(404);
		$data->delete();

    	return Redirect('klasifikasi/'.$request->tahun.'/'.$request->id_kegiatan);
    }
}
