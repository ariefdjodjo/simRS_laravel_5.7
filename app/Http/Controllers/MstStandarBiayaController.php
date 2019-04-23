<?php
/** Controller standar biaya 
 * cek
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstStandarBiaya as StandarBiaya;
use App\RkaklTahun as Tahun;
use App\MstBarang as MstBarang;
use Redirect;
use Storage;
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
			
		);

		$aturan = array(

		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('akun/'.$request->tahun)
                        ->withErrors($validasi)
                        ->withInput();
        }
        //coba
    }
}
