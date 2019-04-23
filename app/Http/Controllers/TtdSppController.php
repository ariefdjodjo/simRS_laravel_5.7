<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;
use Auth;
use DB;
use App\TtdSpp as TtdSpp;

class TtdSppController extends Controller
{
    public function __construct() {
        $this->middleware('level:4');
    }

    public function index() {
    	//menampilkan halaman index
    	$level = Auth::user()->level;
        $data = TtdSpp::all();

    	return view('admin.dashboard.sp.ttdSp',compact('data','level'));  
    }

    protected function tambah(request $request) {
    	$data = new TtdSpp();
    	$data->nama_penandatangan 	= $request->nama_penandatangan;
    	$data->nip_penandatangan	= $request->nip_penandatangan;
    	$data->jabatan 		= $request->jabatan;
    	$data->status 		= 0;
    	$data->save();

    	return redirect('ttdSp');

    }

    protected function edit(request $request, $id) {
    	$data = TtdSpp::find($id);
        $data->nama_penandatangan  = $request->nama_kepala;
        $data->nip_penandatangan   = $request->nip_kepala;
        $data->jabatan      = $request->jabatan;
        $data->update();

        return redirect('ttdSp');
    }

    protected function hapus(request $request, $id) {
        $data = TtdSpp::find($id);
        $data->delete();

        return redirect('ttdSp');
    }

    protected function setDefault(request $request) {
        //reset semua default
        $data = DB::table('ref_ttd_sp')->update(['status' => '0']);

        $id_ttd = $request->id_ttd_sp;

        $setDefault = TtdSpp::find($id_ttd);
        $setDefault->status = 1;
        $setDefault->update();

        return redirect('ttdSp');
    }
}
