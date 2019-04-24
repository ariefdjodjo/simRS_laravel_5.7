<?php
/** Controller standar biaya 
 * cek
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\MstStandarBiaya as StandarBiaya;
use App\RkaklTahun as Tahun;
use App\MstBarang as MstBarang;
use Redirect;
use DB;
use Validator;

class MstStandarBiayaController extends Controller
{
    public function index($tahun){
        $th = Tahun::all();
        $standar = DB::table('ref_standart_biaya')
            ->join('ref_master_barang', 'ref_standart_biaya.id_master_barang', '=', 'ref_master_barang.id_master_barang')
            ->where('ref_standart_biaya.tahun', '=', $tahun)
            ->get();

        return view('admin.dashboard.telaah.standarBiaya',compact('standar', 'th', 'tahun'));
    }

    public function tambah($tahun) {
        $th = $tahun;
        $barang = DB::table('ref_master_barang')->select('*')
            ->whereNotIn('id_master_barang', function($query) use ($th){
                $query->select('id_master_barang')->from('ref_standart_biaya')->where('tahun', $th);
            })->get();

        return view('admin.dashboard.telaah.standarBiayaTambah',compact('tahun', 'barang'));
    }

    public function tambahProses(request $request, $tahun) {
        $input 	= $request->all();
		$pesan 	= array(
            'file.mimes' => 'File dalam format .PDF , .xlsx, .xls, .doc, .docx',
            'file.max' => 'Maksimal 10 MB'
		);

		$aturan = array(
            'file' => 'mimes:pdf,xlsx,xls,doc,docx | max:10240'
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('standarBiaya/tambah/'.$request->tahun)
                        ->withErrors($validasi)
                        ->withInput();
        }
        
        $file = $request->file;
        $name = 'SB-'.$file->getClientOriginalName();
        $path = $file->storeAs('public/standar_biaya', $name);

        $standar = new StandarBiaya();
        $standar->tahun = $tahun;
        $standar->id_master_barang = $request->nama_barang;
        $standar->barang_tersedia = $request->persediaan;
        $standar->kebutuhan = $request->kebutuhan;
        $standar->harga_satuan = $request->harga;
        $standar->dasar_harga = $request->dasar;
        $standar->lampiran = $name;
        $standar->save();

        return Redirect('standarBiaya/'.$tahun);

    }
}
