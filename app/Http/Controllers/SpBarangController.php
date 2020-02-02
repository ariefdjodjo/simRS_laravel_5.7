<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SpBarang as SpBarang;

class SpBarangController extends Controller
{
    
    public function tambahBarangSp(request $request) {
        $data = new SpBarang;
        $data->id_sp    = $request->id_sp;
        $data->id_barang_usulan = $request->id_barang;
        $data->nama_barang_sp      = $request->namaBarang;
        $data->spesifikasi_barang_sp    = $request->spesifikasi;
        $data->satuan_sp        = $request->satuan;
        $data->qty_sp           = $request->qty;
        $data->harga_satuan_sp  = $request->harga;
        $data->save();

        return Redirect('spp/tambah/step3/'.$request->tahun.'/'.$request->id_sp)->with(getNotif('Data berhasil ditambahkan', 'success'));
    }

    public function hapusBarangSp(request $request) {
        $data = SpBarang::find($request->id_barang);
        $data->delete();

        return Redirect('spp/tambah/step3/'.$request->tahun.'/'.$request->id_sp)->with(getNotif('Data berhasil Dihapus', 'error'));
    }   
}
