<?php

namespace App\Http\Controllers;

use App\MstPpk as Ppk;
use App\Helpers;
use Illuminate\Http\Request;

class MstPpkController extends Controller
{
    public function __construct()
    {
        $this->middleware('level:1');
    }

    public function index(){
    	$data = Ppk::all();
    	return view('admin.dashboard.mstPpk.data',compact('data'));
    }

    public function create(request $request){
    	$ppk = new Ppk();
    	$ppk->nama_ppk 	= $request->nama_ppk;
    	$ppk->nip_ppk 	= $request->nip_ppk;
    	$ppk->jabatan_ppk	= $request->jabatan_ppk;
    	$ppk->dasar_ppk 	= $request->dasar_ppk;
    	$ppk->awal_berlaku 	= $request->awal_berlaku;
    	$ppk->akhir_berlaku	= $request->akhir_berlaku;
    	$ppk->save();

    	return Redirect('mstPpk/')->with(getNotif('Data berhasil ditambahkan', 'success'));

    }

    public function setStatus(request $request, $id) {
    	$ppk = Ppk::find($id);
    	$ppk->status_ppk = $request->status;
    	$ppk->update();

    	return Redirect('mstPpk/')->with(getNotif('Data berhasil di Ubah', 'success'));
    }

    public function edit(request $request, $id){
    	$ppk = Ppk::find($id);
    	$ppk->nama_ppk 	= $request->nama_ppk;
    	$ppk->nip_ppk 	= $request->nip_ppk;
    	$ppk->jabatan_ppk	= $request->jabatan_ppk;
    	$ppk->dasar_ppk 	= $request->dasar_ppk;
    	$ppk->awal_berlaku 	= $request->awal_berlaku;
    	$ppk->akhir_berlaku	= $request->akhir_berlaku;
    	$ppk->update();

    	return Redirect('mstPpk/')->with(getNotif('Data berhasil diUbah', 'success'));

    }

    public function hapus(request $request, $id) {
    	$ppk = Ppk::WHERE('id_ppk', '=', $id);
    	if($ppk == null) 
            app::abort(404);
        $ppk->delete();
        return Redirect('mstPpk/')->with(getNotif('Data berhasil dihapus', 'success'));
    }
}
