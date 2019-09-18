<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\MstBarang as MstBarang;

class MstBarangController extends Controller
{
    public function index() {
        $data   = DB::table('ref_master_barang')->select('kode_jenis_barang', DB::raw('count(*) as jum'))->groupby('kode_jenis_barang')->get();

        return view('admin.dashboard.telaah.jenisBarang',compact('data'));
    }

    public function detailMaster($jenis) {
        $data   = MstBarang::where('kode_jenis_barang', '=', $jenis)->get();

        return view('admin.dashboard.telaah.masterBarang',compact('data'));
    }

    public function tambah(request $request) {
        $data = new MstBarang();
        $data->kode_jenis_barang    = $request->kode_jenis_barang;
        $data->nama_barang          = $request->nama_barang;
        $data->spesifikasi          = $request->spesifikasi;
        $data->satuan               = $request->satuan;
        $data->save();

        return back()->with(getNotif('Data '.$data->nama_barang.' berhasil ditambahkan', 'success'));
    }

    public function edit(request $request, $id) {
        $data = MstBarang::find($id);
        $data->kode_jenis_barang    = $request->kode_jenis_barang;
        $data->nama_barang          = $request->nama_barang;
        $data->spesifikasi          = $request->spesifikasi;
        $data->satuan               = $request->satuan;
        $data->update();

        return back()->with(getNotif('Data '.$data->nama_barang.' berhasil di ubah', 'success'));
    }

    public function hapus($id) {
        $data = MstBarang::WHERE('id_master_barang', '=', $id);
    	if($data == null) 
        return back()->with(getNotif('Data tidak dapat dihapus', 'error'));
        $data->delete();

        return back()->with(getNotif('Data berhasil dihapus', 'success'));
    }
}
