<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RkaklTahun as RkaklTahun;
use App\RkaklKegiatan as RkaklKegiatan;
use App\RkaklOutput as RkaklOutput;
use App\RkaklSubOutput as RkaklSubOutput;
use App\RkaklKomponen as RkaklKomponen;
use App\RkaklSubKomponen as RkaklSubKomponen;
use App\RkaklAkun as RkaklAkun;
use App\RkaklSubAlokasi as RkaklSubAlokasi;
use App\MstPpk as MstPpk;
use DB;
use Validator;

class RkaklSubAlokasiController extends Controller
{
    //Membuat Halaman Index
    public function index($tahun, $keg, $output, $subOutput, $komponen, $subKomponen) {
        $th = $tahun;
        $datath            = RkaklTahun::find($tahun);
        $datakegiatan      = RkaklKegiatan::find($keg);
        $dataoutput        = RkaklOutput::find($output);
        $datasubOutput     = RkaklSubOutput::find($subOutput);
        $datakomponen      = RkaklKomponen::find($komponen);
        $datasubKomponen   = RkaklSubKomponen::find($subKomponen);

        $subAlokasi = DB::table('rkakl_sub_alokasi')
            ->leftjoin('rkakl_tahun', 'rkakl_tahun.tahun', '=', 'rkakl_sub_alokasi.tahun')
            ->leftjoin('rkakl_kegiatan', 'rkakl_kegiatan.id_kegiatan', '=', 'rkakl_sub_alokasi.id_kegiatan')
            ->leftjoin('rkakl_output', 'rkakl_output.id_output', '=', 'rkakl_sub_alokasi.id_output')
            ->leftjoin('rkakl_sub_output', 'rkakl_sub_output.id_sub_output', '=', 'rkakl_sub_alokasi.id_sub_output')
            ->leftjoin('rkakl_komponen', 'rkakl_komponen.id_komponen', '=', 'rkakl_sub_alokasi.id_komponen')
            ->leftjoin('rkakl_sub_komponen', 'rkakl_sub_komponen.id_sub_komponen', '=', 'rkakl_sub_alokasi.id_sub_komponen')
            ->leftjoin('rkakl_akun', 'rkakl_akun.id_akun', '=', 'rkakl_sub_alokasi.id_akun')
            ->leftjoin('mst_ppk', 'mst_ppk.id_ppk', '=', 'rkakl_sub_alokasi.id_ppk')
            ->where('rkakl_sub_alokasi.tahun', '=', $tahun)
            ->where('rkakl_sub_alokasi.id_kegiatan', '=', $keg)
            ->where('rkakl_sub_alokasi.id_output', '=', $output)
            ->where('rkakl_sub_alokasi.id_sub_output', '=', $subOutput)
            ->where('rkakl_sub_alokasi.id_komponen', '=', $komponen)
            ->where('rkakl_sub_alokasi.id_sub_komponen', '=', $subKomponen)
            ->get();
        
        return view('admin.dashboard.klasifikasi.subAlokasi',compact('subAlokasi', 'th', 'datath', 'datakegiatan', 'dataoutput', 'datasubOutput', 'datakomponen', 'datasubKomponen'));
    }

    public function detailSa($id){
       // $subAlokasi = RkaklSubAlokasi::find($id);
        
        $subAlokasi = DB::table('rkakl_sub_alokasi')
            ->leftjoin('rkakl_tahun', 'rkakl_tahun.tahun', '=', 'rkakl_sub_alokasi.tahun')
            ->leftjoin('rkakl_kegiatan', 'rkakl_kegiatan.id_kegiatan', '=', 'rkakl_sub_alokasi.id_kegiatan')
            ->leftjoin('rkakl_output', 'rkakl_output.id_output', '=', 'rkakl_sub_alokasi.id_output')
            ->leftjoin('rkakl_sub_output', 'rkakl_sub_output.id_sub_output', '=', 'rkakl_sub_alokasi.id_sub_output')
            ->leftjoin('rkakl_komponen', 'rkakl_komponen.id_komponen', '=', 'rkakl_sub_alokasi.id_komponen')
            ->leftjoin('rkakl_sub_komponen', 'rkakl_sub_komponen.id_sub_komponen', '=', 'rkakl_sub_alokasi.id_sub_komponen')
            ->leftjoin('rkakl_akun', 'rkakl_akun.id_akun', '=', 'rkakl_sub_alokasi.id_akun')
            ->leftjoin('mst_ppk', 'mst_ppk.id_ppk', '=', 'rkakl_sub_alokasi.id_ppk')
            ->where('rkakl_sub_alokasi.id_sub_alokasi', '=', $id)
            ->first();
        
        //$data = array('data' => $subAlokasi);
        return view('admin.dashboard.klasifikasi.detailSubAlokasi',compact('subAlokasi'));
    }

    public function addSA($tahun, $keg, $output, $subOutput, $komponen, $subKomponen){
        $th = $tahun;
        $datath            = RkaklTahun::find($tahun);
        $datakegiatan      = RkaklKegiatan::find($keg);
        $dataoutput        = RkaklOutput::find($output);
        $datasubOutput     = RkaklSubOutput::find($subOutput);
        $datakomponen      = RkaklKomponen::find($komponen);
        $datasubKomponen   = RkaklSubKomponen::find($subKomponen);
        $dataAkun              = RkaklAkun::where('tahun', '=', $tahun)->get();
        $dataPpk            = MstPpk::where('status_ppk', '=', 1)->get();

        return view('admin.dashboard.klasifikasi.addSubAlokasi',compact('th', 'datath', 'datakegiatan', 'dataoutput', 'datasubOutput', 'datakomponen', 'datasubKomponen', 'dataAkun', 'dataPpk'));
    }

    public function addSubAlokasi(request $request){
        $input	= $request->all();
		$pesan 	= array(
			'uraian_sub_alokasi.required' => 'Uraian Tidak boleh Kosong',
            'ppk.required' => 'ID PPK Tidak boleh kosong',
           
            'akun.required' => 'tidak boleh kosong'
		);
		$aturan	= array(
            'uraian_sub_alokasi' => 'required',
            'ppk' => 'required',
            'akun' => 'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);
		
		if ($validasi->fails()) {
            return redirect('klasifikasi/addSA/'.$request->tahun.'/'.$request->kode_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output.'/'.$request->kode_komponen.'/'.$request->kode_sub_komponen)
                        ->withErrors($validasi)
                        ->withInput();
        }
        
        $kode_kl_satker = $request->kl.'.'.$request->satker;
        $data = new RkaklSubAlokasi();
        $data->tahun    = $request->tahun;
        $data->uraian_sub_alokasi = $request->uraian_sub_alokasi;
        $data->kode_kl_satker = $kode_kl_satker;
        $data->id_kegiatan  = $request->kode_kegiatan;
        $data->id_output    = $request->kode_output;
        $data->id_sub_output    = $request->kode_sub_output;
        $data->id_komponen  = $request->kode_komponen;
        $data->id_sub_komponen  = $request->kode_sub_komponen;
        $data->id_akun      = $request->akun;
        $data->id_ppk       = $request->ppk;
        $data->pagu_alokasi = $request->pagu_alokasi;
        $data->save();

        return redirect('klasifikasi/'.$request->tahun.'/'.$request->kode_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output.'/'.$request->kode_komponen.'/'.$request->kode_sub_komponen);
    }

    public function editSA($id){
        // $subAlokasi = RkaklSubAlokasi::find($id);
         
         $subAlokasi = DB::table('rkakl_sub_alokasi')
             ->leftjoin('rkakl_tahun', 'rkakl_tahun.tahun', '=', 'rkakl_sub_alokasi.tahun')
             ->leftjoin('rkakl_kegiatan', 'rkakl_kegiatan.id_kegiatan', '=', 'rkakl_sub_alokasi.id_kegiatan')
             ->leftjoin('rkakl_output', 'rkakl_output.id_output', '=', 'rkakl_sub_alokasi.id_output')
             ->leftjoin('rkakl_sub_output', 'rkakl_sub_output.id_sub_output', '=', 'rkakl_sub_alokasi.id_sub_output')
             ->leftjoin('rkakl_komponen', 'rkakl_komponen.id_komponen', '=', 'rkakl_sub_alokasi.id_komponen')
             ->leftjoin('rkakl_sub_komponen', 'rkakl_sub_komponen.id_sub_komponen', '=', 'rkakl_sub_alokasi.id_sub_komponen')
             ->leftjoin('rkakl_akun', 'rkakl_akun.id_akun', '=', 'rkakl_sub_alokasi.id_akun')
             ->leftjoin('mst_ppk', 'mst_ppk.id_ppk', '=', 'rkakl_sub_alokasi.id_ppk')
             ->where('rkakl_sub_alokasi.id_sub_alokasi', '=', $id)
             ->first();
         $dataPpk = MstPpk::where('status_ppk', '=', 1)->get();
         $dataAkun = RkaklAkun::where('tahun', '=', $subAlokasi->tahun)->get();

         //$data = array('data' => $subAlokasi);
         return view('admin.dashboard.klasifikasi.editSubAlokasi',compact('subAlokasi', 'dataPpk', 'dataAkun'));
     }

    public function prosesEdit(request $request, $id){
        $input	= $request->all();
		$pesan 	= array(
			'uraian_sub_alokasi.required' => 'Uraian Tidak boleh Kosong',
            'ppk.required' => 'ID PPK Tidak boleh kosong',
            'akun.required' => 'tidak boleh kosong'
		);
		$aturan	= array(
            'uraian_sub_alokasi' => 'required',
            'ppk' => 'required',
            'akun' => 'required'
		);

		$validasi = Validator::make($input,$aturan, $pesan);
		
		if ($validasi->fails()) {
            return redirect('editSA/'.$id)
                        ->withErrors($validasi)
                        ->withInput();
        }
        
        $data = RkaklSubAlokasi::find($id);
        $data->uraian_sub_alokasi = $request->uraian_sub_alokasi;
        $data->id_akun      = $request->akun;
        $data->id_ppk       = $request->ppk;
        $data->pagu_alokasi = $request->pagu_alokasi;
        $data->update();

        return redirect('klasifikasi/'.$request->tahun.'/'.$request->kode_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output.'/'.$request->kode_komponen.'/'.$request->kode_sub_komponen);
    } 

    public function prosesHapus(request $request, $id) {
        $data = RkaklSubAlokasi::where('id_sub_alokasi', '=', $id);
        if($data == null) 
            return back();
		$data->delete();
        
        return redirect('klasifikasi/'.$request->tahun.'/'.$request->kode_kegiatan.'/'.$request->kode_output.'/'.$request->kode_sub_output.'/'.$request->kode_komponen.'/'.$request->kode_sub_komponen);
    }

    public function dataAlokasi($th) {
        $data = DB::table('rkakl_sub_alokasi')
            ->leftjoin('rkakl_tahun', 'rkakl_tahun.tahun', '=', 'rkakl_sub_alokasi.tahun')
            ->leftjoin('rkakl_kegiatan', 'rkakl_kegiatan.id_kegiatan', '=', 'rkakl_sub_alokasi.id_kegiatan')
            ->leftjoin('rkakl_output', 'rkakl_output.id_output', '=', 'rkakl_sub_alokasi.id_output')
            ->leftjoin('rkakl_sub_output', 'rkakl_sub_output.id_sub_output', '=', 'rkakl_sub_alokasi.id_sub_output')
            ->leftjoin('rkakl_komponen', 'rkakl_komponen.id_komponen', '=', 'rkakl_sub_alokasi.id_komponen')
            ->leftjoin('rkakl_sub_komponen', 'rkakl_sub_komponen.id_sub_komponen', '=', 'rkakl_sub_alokasi.id_sub_komponen')
            ->leftjoin('rkakl_akun', 'rkakl_akun.id_akun', '=', 'rkakl_sub_alokasi.id_akun')
            ->leftjoin('mst_ppk', 'mst_ppk.id_ppk', '=', 'rkakl_sub_alokasi.id_ppk')
            ->where('rkakl_sub_alokasi.tahun', '=', $th)
            ->get();
        $tahun = $th;
        $data_tahun = RkaklTahun::all();

        return view('admin.dashboard.klasifikasi.pagu',compact('data', 'tahun', 'data_tahun'));
    }

    public function treeView($tahun){
        $data_tahun = RkaklTahun::all();
        //kegiatan
        $kegiatan = RkaklSubAlokasi::where('rkakl_sub_alokasi.tahun', '=', $tahun)
            ->join('rkakl_kegiatan', 'rkakl_kegiatan.id_kegiatan', '=', 'rkakl_sub_alokasi.id_kegiatan')
            ->groupBy('rkakl_sub_alokasi.id_kegiatan', 'rkakl_kegiatan.kode_kegiatan','rkakl_kegiatan.uraian_kegiatan')
            ->select('rkakl_sub_alokasi.id_kegiatan', 'rkakl_kegiatan.kode_kegiatan', 'rkakl_kegiatan.uraian_kegiatan', \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as pg_kegiatan'))
            ->get();

        foreach($kegiatan as $keg) {
            $output[$keg->id_kegiatan] = RkaklSubAlokasi::where('rkakl_sub_alokasi.id_kegiatan', '=', $keg->id_kegiatan)
            ->join('rkakl_output', 'rkakl_sub_alokasi.id_output', '=', 'rkakl_output.id_output')
            ->groupBy('rkakl_sub_alokasi.id_output', 'rkakl_output.uraian_output', 'rkakl_output.kode_output')
            ->select('rkakl_sub_alokasi.id_output',  'rkakl_output.uraian_output', 'rkakl_output.kode_output', \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as total'))
            ->get();

            foreach($output[$keg->id_kegiatan] as $out) {
                $subOutput[$out->id_output] = RkaklSubAlokasi::where('rkakl_sub_alokasi.id_output', '=', $out->id_output)
                ->join('rkakl_sub_output', 'rkakl_sub_alokasi.id_sub_output', '=', 'rkakl_sub_output.id_sub_output')
                ->groupBy('rkakl_sub_alokasi.id_sub_output','rkakl_sub_output.uraian_sub_output', 'rkakl_sub_output.kode_sub_output')
                ->select('rkakl_sub_alokasi.id_sub_output', 'rkakl_sub_output.uraian_sub_output', 'rkakl_sub_output.kode_sub_output', \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as total'))
                ->get();

                foreach($subOutput[$out->id_output] as $so) {
                    $komponen[$so->id_sub_output] = RkaklSubAlokasi::where('rkakl_sub_alokasi.id_sub_output', '=', $so->id_sub_output)
                    ->rightJoin('rkakl_komponen', 'rkakl_sub_alokasi.id_komponen', '=', 'rkakl_komponen.id_komponen')
                    ->groupBy('rkakl_sub_alokasi.id_komponen','rkakl_komponen.uraian_komponen', 'rkakl_komponen.kode_komponen')
                    ->select('rkakl_sub_alokasi.id_komponen', 'rkakl_komponen.uraian_komponen', 'rkakl_komponen.kode_komponen', \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as total'))
                    ->get();
                    
                    foreach($komponen[$so->id_sub_output] as $kom){
                        $subKomponen[$kom->id_komponen] = RkaklSubAlokasi::where('rkakl_sub_alokasi.id_komponen', '=', $kom->id_komponen)
                        ->rightJoin('rkakl_sub_komponen', 'rkakl_sub_alokasi.id_sub_komponen', '=', 'rkakl_sub_komponen.id_sub_komponen')
                        ->groupBy('rkakl_sub_alokasi.id_sub_komponen','rkakl_sub_komponen.uraian_sub_komponen', 'rkakl_sub_komponen.kode_sub_komponen')
                        ->select('rkakl_sub_alokasi.id_sub_komponen', 'rkakl_sub_komponen.uraian_sub_komponen', 'rkakl_sub_komponen.kode_sub_komponen', \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as total'))
                        ->get();

                        foreach($subKomponen[$kom->id_komponen] as $sKom){
                            $sAlokasi[$sKom->id_sub_komponen] = RkaklSubAlokasi::where('rkakl_sub_alokasi.id_sub_komponen', '=', $sKom->id_sub_komponen)
                            ->join('rkakl_akun', 'rkakl_akun.id_akun', '=', 'rkakl_sub_alokasi.id_akun')
                            ->groupBy('rkakl_sub_alokasi.id_sub_alokasi','rkakl_sub_alokasi.uraian_sub_alokasi', 'rkakl_akun.kode_akun', 'rkakl_akun.sumber_dana')
                            ->select('rkakl_sub_alokasi.id_sub_alokasi', 'rkakl_sub_alokasi.uraian_sub_alokasi', 'rkakl_akun.kode_akun', 'rkakl_akun.sumber_dana', \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as total'))
                            ->get();
                        }
                    }
                }
            }

        }

            

        //$komponen = RkaklSubAlokasi::groupBy('id_komponen')->select('*')->get();
        // return response()->json([$kegiatan, $output, $subOutput, $komponen, $subKomponen, $sAlokasi]);
        return view('admin.dashboard.klasifikasi.strukturPagu',compact('kegiatan', 'output', 'subOutput', 'komponen', 'subKomponen', 'sAlokasi', 'tahun', 'data_tahun'));
    }

    public function treeGrid(){
        return view('admin.dashboard.sp.cobaTreeGrid');
    }
}
