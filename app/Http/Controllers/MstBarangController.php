<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\MstBarang as MstBarang;

class MstBarangController extends Controller
{
    public function index() {
        $data   = MstBarang::all();

        return view('admin.dashboard.telaah.masterBarang',compact('data'));
    }

    public function tambah(request $request) {
        $data = new MstBarang();
        $data->kode_jenis_barang    = $request->kode_jenis_barang;
        $data->nama_barang          = $request->nama_barang;
        $data->spesifikasi          = $request->spesifikasi;
        $data->satuan               = $request->satuan;
        $data->save();

        return Redirect('masterBarang/');
    }

    public function edit(request $request, $id) {
        $data = MstBarang::find($id);
        $data->kode_jenis_barang    = $request->kode_jenis_barang;
        $data->nama_barang          = $request->nama_barang;
        $data->spesifikasi          = $request->spesifikasi;
        $data->satuan               = $request->satuan;
        $data->update();

        return Redirect('masterBarang/');
    }

    public function hapus($id) {
        $data = MstBarang::WHERE('id_master_barang', '=', $id);
    	if($data == null) 
            app::abort(404);
        $data->delete();

        return Redirect('masterBarang/');
    }
}
