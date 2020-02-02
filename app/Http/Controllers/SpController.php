<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Validator;
use Storage;
use Mail;
use PDF;
use App\Usulan as Usulan;
use App\Mail\SentMail;
use App\TtdUsulan as TtdUsulan;
use App\TtdTelaah as TtdTelaah;
use App\TtdSpp as TtdSpp;
use App\RkaklTahun as Tahun;
use App\RkaklSubAlokasi as SubAlokasi;
use App\Telaah as Telaah;
use App\UsulanLampiran as Lampiran;
use App\UsulanBarang as Barang;
use App\MstBarang as MstBarang;
use App\SpBarang as SpBarang;
use App\Sp as Sp;

class SpController extends Controller
{
    public function step1($id){
        $tahun = Tahun::all();

        if($id!=0) {
            $tahunSp = Sp::select('tahun')->where('id_sp', '=', 'id');
        }
        
        return view('admin.dashboard.sp.step1Sp', compact('tahun', 'id', 'tahunSp'));
    }

    public function pilihTahun(request $request){
        $tahun = $request->tahun;

        return Redirect('spp/tambah/step2/'.$tahun.'/0')->with(getNotif('Berhasil pilih tahun anggaran', 'success'));
    }

    public function step2(request $request, $tahun, $id){
        $tahun = $request->tahun;
        $user   = Auth::User()->id;
        $subAlokasi     = SubAlokasi::where('tahun', '=', $tahun)->with('akun')->get();
        $telaah     = Telaah::join('usulan', 'telaah.id_usulan', '=', 'usulan.id_usulan')
            ->where('telaah.tgl_kirim', '!=', NULL)
            ->whereNotIn('telaah.id_telaah', function($query){
                $query->select('sp.id_telaah')->from('sp');  
            })
            ->get();

        $ttdSP = TtdSpp::all();

        if($id != 0) {
            $sp    = Sp::where('id_sp', '=', $id)->with('sA', 'penandatangan', 'telaah')->first();
        }
        

        return view('admin.dashboard.sp.step2Sp', compact('tahun', 'user', 'subAlokasi', 'telaah', 'ttdSP', 'id', 'sp'));
    }

    public function loadUsulanTelaah($id){
        $telaah     = Telaah::join('usulan', 'telaah.id_usulan', '=', 'usulan.id_usulan')
            ->join('mst_unit_kerja', 'usulan.id_unit_kerja', '=', 'mst_unit_kerja.id_unit_kerja')
            ->join('usulan_barang', 'usulan_barang.id_usulan', '=', 'usulan.id_usulan')
            ->groupBy(
                'usulan.no_usulan',
                'usulan.tgl_usulan',
                'usulan.perihal_usulan',
                'usulan.isi_usulan',
                'mst_unit_kerja.nama_unit_kerja',
                'telaah.no_telaah',
                'telaah.tgl_telaah',
                'telaah.analisis_kebutuhan',
                'telaah.alasan_kebutuhan',
                'telaah.urgency'
            )
            ->select(
                'usulan.no_usulan',
                'usulan.tgl_usulan',
                'usulan.perihal_usulan',
                'usulan.isi_usulan',
                'mst_unit_kerja.nama_unit_kerja',
                'telaah.no_telaah',
                'telaah.tgl_telaah',
                'telaah.analisis_kebutuhan',
                'telaah.alasan_kebutuhan',
                'telaah.urgency',
                \DB::raw('sum(usulan_barang.jumlah_harga_telaah) as total_telaah'),
                \DB::raw('sum(usulan_barang.jumlah_usulan) as total_usulan')
            )
            ->where('telaah.id_telaah', '=', $id)
            ->where('telaah.tgl_kirim', '!=', NULL)
            ->first();

        return view('admin.dashboard.sp.loadUsulanTelaah', compact('telaah'));
    }

    public function simpanSp(request $request){
        if($request->id == 0) {
            $data = new Sp;
            $data->user_input = $request->user;
            $data->tahun    = $request->tahun;
            $data->id_telaah   = $request->telaah;
            $data->no_sp    = $request->nosp;
            $data->tgl_sp   = $request->tglsp;
            $data->hal_sp   = $request->halsp;
            $data->id_sub_alokasi   = $request->idalokasi;
            $data->penandatangan_sp = $request->penandatangan;
            $data->save();

            return Redirect('spp/tambah/step2/'.$request->tahun.'/'.$data->id_sp)->with(getNotif('Data berhasil di tambahkan', 'success'));

        } else {
            $data   = SP::find($request->id);
            $data->user_input = $request->user;
            $data->id_telaah   = $request->telaah;
            $data->no_sp    = $request->nosp;
            $data->tgl_sp   = $request->tglsp;
            $data->hal_sp   = $request->halsp;
            $data->id_sub_alokasi   = $request->idalokasi;
            $data->penandatangan_sp = $request->penandatangan;
            $data->update();

            return Redirect('spp/tambah/step2/'.$request->tahun.'/'.$data->id_sp)->with(getNotif('Data berhasil di Update', 'success'));
        }
    }

    public function step3($tahun, $id){
        $sp     = SP::find($id);
        $barangTelaah = Barang::join('telaah', 'telaah.id_usulan', '=', 'usulan_barang.id_usulan')
            ->where('telaah.id_telaah', '=', $sp->id_telaah)
            ->whereNotNull('jumlah_harga_telaah')
            ->Where('jumlah_harga_telaah', '!=', 0)
            ->whereNotIn('usulan_barang.id_barang_usulan', function($query){
                $query->select('sp_barang.id_barang_usulan')->from('sp_barang');   
            })
            ->get();
        $countBarangTelaah = $barangTelaah->count('id_barang');
        $barangSp   = SpBarang::where('id_sp', '=', $id)->get();
        $countBarangSp = $barangSp->count('id_barang_sp');

        return view('admin.dashboard.sp.step3Sp', compact('tahun', 'id', 'barangTelaah', 'sp', 'barangSp', 'countBarangSp', 'countBarangTelaah'));
    }

    public function step4($tahun, $id){
        $sp     = SP::where('id_sp', '=', $id)->with('sA', 'penandatangan', 'telaah')->first();
        $barangSp = SpBarang::where('id_sp', '=', $id)->get();
        $countBarangSp  = count($barangSp);

        return view('admin.dashboard.sp.step4Sp', compact('tahun', 'id', 'barangSp', 'countBarangSp', 'sp'));
    }

    public function step5($tahun, $id){
        $sp     = SP::where('id_sp', '=', $id)->with('sA', 'penandatangan', 'telaah')->first();
        $barangSp = SpBarang::where('id_sp', '=', $id)->get();
        $countBarangSp  = count($barangSp);

        return view('admin.dashboard.sp.step5Sp', compact('tahun', 'id', 'barangSp', 'countBarangSp', 'sp'));
    }

    public function pdfSp($id, $template){
        $sp     = SP::where('id_sp', '=', $id)->with('sA', 'penandatangan', 'telaah', 'barangSp')->first();
        
        $pdf = PDF::loadview('admin.dashboard.sp.pdfCetakSp', compact('template', 'id', 'sp', 'jumHarga', 'total'));

        return $pdf->stream();
    }

    protected function kirimSp(request $request, $tahun, $id){
        $tgl = date('Y-m-d');
        $data = Sp::find($id);
        $data->status_sp = 'Aktif';
        $data->no_sp    = $request->no_sp;
        $data->tgl_kirim_sp  =   $tgl;
        $data->update();

        return redirect('spp/tambah/step5/'.$tahun.'/'.$id)->with(getNotif('Data berhasil di dikirimkan', 'success')); 
    }

    public function batalSp(request $request, $tahun, $id){
        $data = Sp::find($id);
        $data->status_sp = 'Batal';
        $data->catatan_sp = $request->catatan;
        $data->update();

        return redirect('spp/tambah/step5/'.$tahun.'/'.$id)->with(getNotif('Data berhasil di dibatalkan', 'success')); 
    }

    public function dataSp($tahun){
        $sp = SP::where('tahun', '=', $tahun)->get();
        $th  = Tahun::all();

        return view('admin.dashboard.sp.dataSp', compact('tahun', 'sp', 'th'));
    }

    public function laporanSp($tahun){
        if($tahun == 0) {
            $rekap  = Tahun::leftJoin('rkakl_sub_alokasi', 'rkakl_sub_alokasi.tahun', 'rkakl_tahun.tahun')
                ->groupBy('rkakl_tahun.tahun')
                ->select(
                    'rkakl_tahun.tahun',
                    \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as pagu')
                )
                ->get();
            foreach($rekap as $th){
                $serapan[$th->tahun] = Sp::join('sp_barang', 'sp_barang.id_sp', 'sp.id_sp')
                    ->select(\DB::raw('sum(sp_barang.qty_sp*sp_barang.harga_satuan_sp) as penyerapan'))
                    ->groupBy('sp.tahun')
                    ->where('sp.status_sp', '=', 'Aktif')
                    ->where('sp.tahun', '=', $th->tahun)
                    ->first();
                
                $aktif[$th->tahun] = Sp::where('sp.status_sp', '=', 'Aktif')->where('sp.tahun', '=', $th->tahun)->count('sp.id_sp');
                $draft[$th->tahun] = Sp::whereNull('sp.status_sp')->where('sp.tahun', '=', $th->tahun)->count('sp.id_sp');
                $batal[$th->tahun] = Sp::where('sp.status_sp', '=', 'Batal')->where('sp.tahun', '=', $th->tahun)->count('sp.id_sp');
            }
        } else {
            $kegiatan = SubAlokasi::where('rkakl_sub_alokasi.tahun', '=', $tahun)
            ->join('rkakl_kegiatan', 'rkakl_kegiatan.id_kegiatan', '=', 'rkakl_sub_alokasi.id_kegiatan')
            ->groupBy('rkakl_sub_alokasi.id_kegiatan', 'rkakl_kegiatan.kode_kegiatan','rkakl_kegiatan.uraian_kegiatan')
            ->select('rkakl_sub_alokasi.id_kegiatan', 'rkakl_kegiatan.kode_kegiatan', 'rkakl_kegiatan.uraian_kegiatan', \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as pg_kegiatan'))
            ->first();

            $serapanKeg = Sp::join('sp_barang', 'sp_barang.id_sp', 'sp.id_sp')
                ->join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                ->select(\DB::raw('sum(sp_barang.qty_sp*sp_barang.harga_satuan_sp) as penyerapan'))
                ->groupBy('sp.tahun')
                ->where('sp.status_sp', '=', 'Aktif')
                ->where('sp.tahun', '=', $tahun)
                ->first();
            
            $aktifKeg = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                ->where('sp.status_sp', '=', 'Aktif')
                ->where('sp.tahun', '=', $tahun)
                ->where('rkakl_sub_alokasi.id_kegiatan', '=', $kegiatan->id_kegiatan)
                ->count('sp.id_sp');

            $draftKeg = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                ->whereNull('sp.status_sp')
                ->where('sp.tahun', '=', $tahun)
                ->where('rkakl_sub_alokasi.id_kegiatan', '=', $kegiatan->id_kegiatan)
                ->count('sp.id_sp');

            $batalKeg = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                ->where('sp.status_sp', '=', 'Batal')
                ->where('sp.tahun', '=', $tahun)
                ->where('rkakl_sub_alokasi.id_kegiatan', '=', $kegiatan->id_kegiatan)
                ->count('sp.id_sp');

            $output = SubAlokasi::where('rkakl_sub_alokasi.id_kegiatan', '=', $kegiatan->id_kegiatan)
                ->join('rkakl_output', 'rkakl_sub_alokasi.id_output', '=', 'rkakl_output.id_output')
                ->groupBy('rkakl_sub_alokasi.id_output', 'rkakl_output.uraian_output', 'rkakl_output.kode_output')
                ->select('rkakl_sub_alokasi.id_output',  'rkakl_output.uraian_output', 'rkakl_output.kode_output', \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as total'))
                ->get();
            
                foreach($output as $out) {
                    $serapanOut[$out->id_output] = Sp::join('sp_barang', 'sp_barang.id_sp', 'sp.id_sp')
                        ->join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                        ->select(\DB::raw('sum(sp_barang.qty_sp*sp_barang.harga_satuan_sp) as penyerapan'))
                        ->groupBy('rkakl_sub_alokasi.id_output')
                        ->where('sp.status_sp', '=', 'Aktif')
                        ->where('rkakl_sub_alokasi.id_output', '=', $out->id_output)
                        ->first();
                    
                    $aktifOut[$out->id_output] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                        ->where('sp.status_sp', '=', 'Aktif')
                        ->where('rkakl_sub_alokasi.id_output', '=', $out->id_output)
                        ->count('sp.id_sp');

                    $draftOut[$out->id_output] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                        ->whereNull('sp.status_sp')
                        ->where('rkakl_sub_alokasi.id_output', '=', $out->id_output)
                        ->count('sp.id_sp');

                    $batalOut[$out->id_output] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                        ->where('sp.status_sp', '=', 'Batal')
                        ->where('rkakl_sub_alokasi.id_output', '=', $out->id_output)
                        ->count('sp.id_sp');

                    $subOutput[$out->id_output] = SubAlokasi::where('rkakl_sub_alokasi.id_output', '=', $out->id_output)
                    ->join('rkakl_sub_output', 'rkakl_sub_alokasi.id_sub_output', '=', 'rkakl_sub_output.id_sub_output')
                    ->groupBy('rkakl_sub_alokasi.id_sub_output','rkakl_sub_output.uraian_sub_output', 'rkakl_sub_output.kode_sub_output')
                    ->select('rkakl_sub_alokasi.id_sub_output', 'rkakl_sub_output.uraian_sub_output', 'rkakl_sub_output.kode_sub_output', \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as total'))
                    ->get();

                    foreach($subOutput[$out->id_output] as $so) {
                        $serapanSubOut[$so->id_sub_output] = Sp::join('sp_barang', 'sp_barang.id_sp', 'sp.id_sp')
                            ->join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                            ->select(\DB::raw('sum(sp_barang.qty_sp*sp_barang.harga_satuan_sp) as penyerapan'))
                            ->groupBy('rkakl_sub_alokasi.id_sub_output')
                            ->where('sp.status_sp', '=', 'Aktif')
                            ->where('rkakl_sub_alokasi.id_sub_output', '=', $so->id_sub_output)
                            ->first();
                        
                        $aktifSubOut[$so->id_sub_output] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                            ->where('sp.status_sp', '=', 'Aktif')
                            ->where('rkakl_sub_alokasi.id_sub_output', '=', $so->id_sub_output)
                            ->count('sp.id_sp');

                        $draftSubOut[$so->id_sub_output] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                            ->whereNull('sp.status_sp')
                            ->where('rkakl_sub_alokasi.id_sub_output', '=', $so->id_sub_output)
                            ->count('sp.id_sp');

                        $batalSubOut[$so->id_sub_output] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                            ->where('sp.status_sp', '=', 'Batal')
                            ->where('rkakl_sub_alokasi.id_sub_output', '=', $so->id_sub_output)
                            ->count('sp.id_sp');

                        $komponen[$so->id_sub_output] = SubAlokasi::where('rkakl_sub_alokasi.id_sub_output', '=', $so->id_sub_output)
                        ->rightJoin('rkakl_komponen', 'rkakl_sub_alokasi.id_komponen', '=', 'rkakl_komponen.id_komponen')
                        ->groupBy('rkakl_sub_alokasi.id_komponen','rkakl_komponen.uraian_komponen', 'rkakl_komponen.kode_komponen')
                        ->select('rkakl_sub_alokasi.id_komponen', 'rkakl_komponen.uraian_komponen', 'rkakl_komponen.kode_komponen', \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as total'))
                        ->get();

                        foreach($komponen[$so->id_sub_output] as $kom){
                            $serapanKomp[$kom->id_komponen] = Sp::join('sp_barang', 'sp_barang.id_sp', 'sp.id_sp')
                                ->join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                                ->select(\DB::raw('sum(sp_barang.qty_sp*sp_barang.harga_satuan_sp) as penyerapan'))
                                ->groupBy('rkakl_sub_alokasi.id_komponen')
                                ->where('sp.status_sp', '=', 'Aktif')
                                ->where('rkakl_sub_alokasi.id_komponen', '=', $kom->id_komponen)
                                ->first();
                            
                            $aktifKomp[$kom->id_komponen] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                                ->where('sp.status_sp', '=', 'Aktif')
                                ->where('rkakl_sub_alokasi.id_komponen', '=', $kom->id_komponen)
                                ->count('sp.id_sp');

                            $draftKomp[$kom->id_komponen] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                                ->whereNull('sp.status_sp')
                                ->where('rkakl_sub_alokasi.id_komponen', '=', $kom->id_komponen)
                                ->count('sp.id_sp');

                            $batalKomp[$kom->id_komponen] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                                ->where('sp.status_sp', '=', 'Batal')
                                ->where('rkakl_sub_alokasi.id_komponen', '=', $kom->id_komponen)
                                ->count('sp.id_sp');

                            $subKomponen[$kom->id_komponen] = SubAlokasi::where('rkakl_sub_alokasi.id_komponen', '=', $kom->id_komponen)
                            ->rightJoin('rkakl_sub_komponen', 'rkakl_sub_alokasi.id_sub_komponen', '=', 'rkakl_sub_komponen.id_sub_komponen')
                            ->groupBy('rkakl_sub_alokasi.id_sub_komponen','rkakl_sub_komponen.uraian_sub_komponen', 'rkakl_sub_komponen.kode_sub_komponen')
                            ->select('rkakl_sub_alokasi.id_sub_komponen', 'rkakl_sub_komponen.uraian_sub_komponen', 'rkakl_sub_komponen.kode_sub_komponen', \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as total'))
                            ->get();

                            foreach($subKomponen[$kom->id_komponen] as $sKom){
                                $serapanSubKomp[$sKom->id_sub_komponen] = Sp::join('sp_barang', 'sp_barang.id_sp', 'sp.id_sp')
                                ->join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                                ->select(\DB::raw('sum(sp_barang.qty_sp*sp_barang.harga_satuan_sp) as penyerapan'))
                                ->groupBy('rkakl_sub_alokasi.id_sub_komponen')
                                ->where('sp.status_sp', '=', 'Aktif')
                                ->where('rkakl_sub_alokasi.id_sub_komponen', '=', $sKom->id_sub_komponen)
                                ->first();
                            
                            $aktifSubKomp[$sKom->id_sub_komponen] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                                ->where('sp.status_sp', '=', 'Aktif')
                                ->where('rkakl_sub_alokasi.id_sub_komponen', '=', $sKom->id_sub_komponen)
                                ->count('sp.id_sp');

                            $draftSubKomp[$sKom->id_sub_komponen] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                                ->whereNull('sp.status_sp')
                                ->where('rkakl_sub_alokasi.id_sub_komponen', '=', $sKom->id_sub_komponen)
                                ->count('sp.id_sp');

                            $batalSubKomp[$sKom->id_sub_komponen] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                                ->where('sp.status_sp', '=', 'Batal')
                                ->where('rkakl_sub_alokasi.id_sub_komponen', '=', $sKom->id_sub_komponen)
                                ->count('sp.id_sp');

                                $sAlokasi[$sKom->id_sub_komponen] = SubAlokasi::where('rkakl_sub_alokasi.id_sub_komponen', '=', $sKom->id_sub_komponen)
                                ->join('rkakl_akun', 'rkakl_akun.id_akun', '=', 'rkakl_sub_alokasi.id_akun')
                                ->groupBy('rkakl_sub_alokasi.id_sub_alokasi','rkakl_sub_alokasi.uraian_sub_alokasi', 'rkakl_akun.kode_akun', 'rkakl_akun.sumber_dana')
                                ->select('rkakl_sub_alokasi.id_sub_alokasi', 'rkakl_sub_alokasi.uraian_sub_alokasi', 'rkakl_akun.kode_akun', 'rkakl_akun.sumber_dana', \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as total'))
                                ->get();

                                foreach ($sAlokasi[$sKom->id_sub_komponen] as $akun) {
                                    $serapanAkun[$akun->id_akun] = Sp::join('sp_barang', 'sp_barang.id_sp', 'sp.id_sp')
                                    ->join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                                    ->select(\DB::raw('sum(sp_barang.qty_sp*sp_barang.harga_satuan_sp) as penyerapan'))
                                    ->groupBy('rkakl_sub_alokasi.id_akun')
                                    ->where('sp.status_sp', '=', 'Aktif')
                                    ->where('rkakl_sub_alokasi.id_akun', '=', $akun->id_akun)
                                    ->first();
                                
                                $aktifAkun[$akun->id_akun] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                                    ->where('sp.status_sp', '=', 'Aktif')
                                    ->where('rkakl_sub_alokasi.id_akun', '=', $akun->id_akun)
                                    ->count('sp.id_sp');
    
                                $draftAkun[$akun->id_akun] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                                    ->whereNull('sp.status_sp')
                                    ->where('rkakl_sub_alokasi.id_akun', '=', $akun->id_akun)
                                    ->count('sp.id_sp');
    
                                $batalAkun[$akun->id_akun] = Sp::join('rkakl_sub_alokasi', 'sp.id_sub_alokasi', '=', 'rkakl_sub_alokasi.id_sub_alokasi')
                                    ->where('sp.status_sp', '=', 'Batal')
                                    ->where('rkakl_sub_alokasi.id_akun', '=', $akun->id_akun)
                                    ->count('sp.id_sp');
                                }
                            }
                        }
                    }
                }
        }

        return view('admin.dashboard.laporan.laporanSp', compact('tahun', 'rekap', 'serapan', 'aktif', 'draft', 'batal', 'kegiatan', 'output', 'subOutput', 'komponen', 'subKomponen', 'sAlokasi', 'tahun', 'data_tahun', 'serapanKeg', 'aktifKeg', 'batalKeg', 'draftKeg', 'serapanOut', 'aktifOut', 'batalOut', 'draftOut', 'serapanSubOut', 'aktifSubOut', 'batalSubOut', 'draftSubOut', 'serapanKomp', 'aktifKomp', 'batalKomp', 'draftKomp', 'serapanSubKomp', 'aktifSubKomp', 'batalSubKomp', 'draftSubKomp', 'serapanAkun', 'aktifAkun', 'batalAkun', 'draftAkun'));
    }

    public function efisiensi($tahun){
        if($tahun == 0) {
            $rekap  = Tahun::leftJoin('rkakl_sub_alokasi', 'rkakl_sub_alokasi.tahun', 'rkakl_tahun.tahun')
                ->groupBy('rkakl_tahun.tahun')
                ->select(
                    'rkakl_tahun.tahun',
                    \DB::raw('sum(rkakl_sub_alokasi.pagu_alokasi) as pagu')
                )
                ->get();
            foreach ($rekap as $th) {
                $rabUsulan[$th->tahun]  = Barang::join('usulan', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
                    ->where('usulan.tahun', '=', $th->tahun)
                    ->whereNotNull('usulan.tgl_kirim')
                    ->select(DB::raw('sum(usulan_barang.jumlah_usulan) as rab_usulan'))
                    ->first();
                
                $rabTelaah[$th->tahun] = Barang::join('usulan', 'usulan.id_usulan', '=', 'usulan_barang.id_usulan')
                    ->join('telaah', 'usulan.id_usulan', '=', 'telaah.id_usulan')
                    ->where('usulan.tahun', '=', $th->tahun)
                    ->whereNotNull('telaah.tgl_kirim')
                    ->select(DB::raw('sum(usulan_barang.jumlah_harga_telaah) as rab_telaah'))
                    ->first();
                
                $rabSp[$th->tahun] = SpBarang::join('sp', 'sp.id_sp', '=', 'sp_barang.id_sp')
                    ->where('sp.tahun', '=', $th->tahun)
                    ->whereNotNull('tgl_kirim_sp')
                    ->where('sp.status_sp', '=', "Aktif")
                    ->select(DB::raw('sum(sp_barang.qty_sp*sp_barang.harga_satuan_sp) as rab_sp'))
                    ->first();
                $sisa[$th->tahun] = $th->pagu-$rabSp[$th->tahun]->rab_sp;
            }
        }
        $sub_alokasi    = SubAlokasi::where('tahun', '=', $tahun)->get();
        
        return view('admin.dashboard.laporan.efisiensiSp', compact('sub_alokasi', 'tahun', 'rekap', 'rabUsulan', 'rabTelaah', 'rabSp', 'sisa'));
    }
}
