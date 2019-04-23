<?php

namespace App\Http\Controllers;

use App\MstUnitKerja as UnitKerja;
use App\TtdUsulan as TtdUsulan;
use Auth;
use DB;
use Illuminate\Http\Request;

class TtdUsulanController extends Controller
{
    public function __construct() {
        $this->middleware('level:2');
    }

    public function index() {
    	//menampilkan halaman index
    	$id_satker = Auth::user()->id_unit_kerja;
        $data = DB::table('ref_ttd_usulan')
            ->leftjoin('mst_unit_kerja', 'mst_unit_kerja.id_unit_kerja', '=', 'ref_ttd_usulan.id_unit_kerja')
            ->where('ref_ttd_usulan.id_unit_kerja', '=', $id_satker)
            ->get();
    	return view('admin.dashboard.usulan.ttdUsulan',compact('data','list_ttd'));  
    }

    protected function tambah(request $request) {
    	$data = new TtdUsulan();
    	$data->nama_kepala 	= $request->nama_kepala;
    	$data->id_unit_kerja = $request->id_unit_kerja;
    	$data->nip_kepala	= $request->nip_kepala;
    	$data->jabatan 		= $request->jabatan;
    	$data->status 		= 0;
    	$data->save();

    	return redirect('ttdUsulan');

    }

    protected function edit(request $request, $id) {
    	$data = TtdUsulan::find($id);
        $data->nama_kepala  = $request->nama_kepala;
        $data->nip_kepala   = $request->nip_kepala;
        $data->jabatan      = $request->jabatan;
        $data->update();

        return redirect('ttdUsulan');
    }

    protected function hapus(request $request, $id) {
        $data = TtdUsulan::find($id);
        $data->delete();

        return redirect('ttdUsulan');
    }

    protected function setDefault(request $request) {
        $id_satker = Auth::user()->id_unit_kerja;

        //reset semua default
        $data = DB::table('ref_ttd_usulan')->where('ref_ttd_usulan.id_unit_kerja', '=', $id_satker)
        ->update(['status' => '0']);


        $id_ttd = $request->id_ttd_usulan;

        $setDefault = TtdUsulan::find($id_ttd);
        $setDefault->status = 1;
        $setDefault->update();

        return redirect('ttdUsulan');
    }
}
