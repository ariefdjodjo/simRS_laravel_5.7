<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\TtdTelaah as TtdTelaah;

class TtdTelaahController extends Controller
{
    public function __construct() {
        $this->middleware('level:3');
    }

    public function index() {
    	//menampilkan halaman index
    	$level = Auth::user()->level;
        $data = TtdTelaah::all();

    	return view('admin.dashboard.telaah.ttdTelaah',compact('data','level'));  
    }

    protected function tambah(request $request) {
    	$data = new TtdTelaah();
    	$data->nama_penelaah 	= $request->nama_penandatangan;
    	$data->nip_penelaah	= $request->nip_penandatangan;
    	$data->jabatan 		= $request->jabatan;
    	$data->status 		= 0;
    	$data->save();

    	return redirect('ttdTelaah');

    }

    protected function edit(request $request, $id) {
    	$data = TtdTelaah::find($id);
        $data->nama_penelaah  = $request->nama_kepala;
        $data->nip_penelaah   = $request->nip_kepala;
        $data->jabatan      = $request->jabatan;
        $data->update();

        return redirect('ttdTelaah');
    }

    protected function hapus(request $request, $id) {
        $data = TtdTelaah::find($id);
        $data->delete();

        return redirect('ttdTelaah');
    }

    protected function setDefault(request $request) {
        //reset semua default
        $data = DB::table('ref_ttd_telaah')->update(['status' => '0']);

        $id_ttd = $request->id_ttd_telaah;

        $setDefault = DB::table('ref_ttd_telaah')->where('id_ttd_telaah', '=', $id_ttd)->update(['status' => '1']);

        return redirect('ttdTelaah');
    }
}
