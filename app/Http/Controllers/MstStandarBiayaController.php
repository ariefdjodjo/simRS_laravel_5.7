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
use DB;
use Form;
use Storage;
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
            'file' => 'mimes:pdf,xlsx,xls,doc,docx', 
            'file' => 'max:10000'
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('standarBiaya/tambah/'.$request->tahun)
                        ->withErrors($validasi)
                        ->withInput();
        }
        
        $file = $request->file;
        $name = 'SB-'.$request->nama_barang.'_'.$file->getClientOriginalName();
        $path = $file->storeAs('public/standar_biaya/', $name);

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

    public function edit($tahun, $id) {
        $barang = DB::table('ref_master_barang')->select('*')
        ->whereNotIn('id_master_barang', function($query) use ($tahun){
            $query->select('id_master_barang')->from('ref_standart_biaya')->where('tahun', $tahun);
        })->get();

        $standar = DB::table('ref_standart_biaya')
            ->join('ref_master_barang', 'ref_standart_biaya.id_master_barang', '=', 'ref_master_barang.id_master_barang')
            ->where('ref_standart_biaya.id_kebutuhan_barang', '=', $id)
            ->first();

        return view('admin.dashboard.telaah.standarBiayaEdit',compact('tahun', 'barang', 'standar'));
    }

    public function prosesEdit(request $request, $tahun){
        $input 	= $request->all();
		$pesan 	= array(
            'file.mimes' => 'File dalam format .PDF , .xlsx, .xls, .doc, .docx',
            'file.max' => 'Maksimal 10 MB'
		);

		$aturan = array(
            'file' => 'mimes:pdf,xlsx,xls,doc,docx', 
            'file' => 'max:10000'
		);

		$validasi = Validator::make($input,$aturan, $pesan);

		if ($validasi->fails()) {
            return redirect('standarBiaya/edit/'.$tahun.'/'.$request->id_sb)
                        ->withErrors($validasi)
                        ->withInput();
        }
        
        $file = $request->file;
        if($file != ""){
            $name = 'SB-'.$request->nama_barang.'_'.$file->getClientOriginalName();
            $oldFile = StandarBiaya::find($request->id_sb)['lampiran'];
            Storage::delete('public/standar_biaya/'.$oldFile);
            $path = $file->storeAs('public/standar_biaya/', $name);

            $standar = StandarBiaya::find($request->id_sb);
            $standar->id_master_barang = $request->nama_barang;
            $standar->barang_tersedia = $request->persediaan;
            $standar->kebutuhan = $request->kebutuhan;
            $standar->harga_satuan = $request->harga;
            $standar->dasar_harga = $request->dasar;
            $standar->lampiran = $name;
            $standar->update();
        } else {
            $standar = StandarBiaya::find($request->id_sb);
            $standar->id_master_barang = $request->nama_barang;
            $standar->barang_tersedia = $request->persediaan;
            $standar->kebutuhan = $request->kebutuhan;
            $standar->harga_satuan = $request->harga;
            $standar->dasar_harga = $request->dasar;
            $standar->update();
        }
        return Redirect('standarBiaya/'.$tahun);
    }

    public function hapus($tahun, $id){
        $oldFile = StandarBiaya::find($id)['lampiran'];
        Storage::delete('public/standar_biaya/'.$oldFile);
        
        $data = DB::table('ref_standart_biaya')->where('id_kebutuhan_barang', '=', $id);
        if($data == null) 
            app::abort(404);
        $data->delete();

        return Redirect('standarBiaya/'.$tahun);
    }

}
