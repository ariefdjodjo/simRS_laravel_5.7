<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Validator;
use Storage;
use Mail;
use PDF;
use App\Usulan as Usulan;
use App\Mail\SentMail;
use App\TtdUsulan as TtdUsulan;
use App\RkaklTahun as Tahun;
use App\MstUnitKerja as UnitKerja;
use App\UsulanLampiran as Lampiran;
use App\UsulanBarang as Barang;
use App\MstBarang as MstBarang;
use App\Telaah as Telaah;
use App\Sp as Sp;
use App\Email as Email;



class AdminController extends Controller
{

    public function __construct(Request $request)
    {
      $this->middleware('auth');
    }
    
    public function index(Request $request){
      

      $level = Auth::user()->level;

      if($level == NULL) {
        return view('home');
      } else {

          switch ($level) {
            case "1":
                return $this->dashboardLevel1(); //Admin
                break;
            case "2":            
                return $this->dashboardLevel2(); //Usulan
                break;
            case "3":
                return $this->dashboardLevel3(); //Telaah
                break;
            case "4":
                return $this->dashboardLevel4(); //SSP
                break;
              case "5":
                return $this->dashboardLevel5(); //Manajemen
                break;
            default:
                echo "Dashboard SimRSS!";
          }
        }
    }

    protected function dashBoardLevel1(){

      $usulan     = Usulan::whereNotNull('tgl_kirim')
        ->count('id_usulan'); 

      $telaah     = Telaah::join('usulan', 'usulan.id_usulan', '=', 'telaah.id_usulan')
        ->whereNotNull('telaah.tgl_kirim')
        ->count('telaah.id_telaah'); 
      
      $sp     = Sp::whereNotNull('tgl_kirim_sp')
          ->where('status_sp', '=', 'Aktif')
          ->count('sp.id_sp'); 
          
      return view('admin.dashboard.index.mainadmin',compact('usulan','telaah', 'sp', 'tahun'));
    }

    protected function dashBoardLevel2(){
      // $grafik   = Usulan::select(DB::raw('count(*) as jumUsulan'), 'jenis_usulan')
      //   ->groupBy('jenis_usulan')
      //   ->whereNotNull('tgl_kirim')
      //   ->get();

      $grafik     = Usulan::select(DB::raw("sum(jenis_usulan = '5201') as cetakan, 
            sum(jenis_usulan = '5202') as atk, 
            sum(jenis_usulan = '5203') as brt,
            sum(jenis_usulan = '5204') as obat,
            sum(jenis_usulan = '5205') as amhp,
            sum(jenis_usulan = '5206') as operasional,
            sum(jenis_usulan = '5207') as jasa,
            sum(jenis_usulan = '5208') as bm,
            sum(jenis_usulan = '5301') as alkes,
            sum(jenis_usulan = '5302') as nonMed,
            sum(jenis_usulan = '5303') as ppd"), 'tahun')
        ->groupBy('tahun')
        ->get();

      return view('admin.dashboard.index.mainpengusul', compact('grafik'));
    }

    protected function dashBoardLevel3(){
      $tahun = date('Y');
      $usulan     = Usulan::where('tahun', '=', $tahun)
          ->whereNotNull('tgl_kirim')
          ->count('id_usulan'); 

      $telaah     = Telaah::join('usulan', 'usulan.id_usulan', '=', 'telaah.id_usulan')
          ->where('usulan.tahun', '=', $tahun)
          ->whereNotNull('telaah.tgl_kirim')
          ->count('telaah.id_telaah'); 
      
      $sp     = Sp::where('tahun', '=', $tahun)
          ->whereNotNull('tgl_kirim_sp')
          ->where('status_sp', '=', 'Aktif')
          ->count('sp.id_sp'); 
        
        return view('admin.dashboard.index.maintelaah',compact('usulan','telaah', 'sp', 'tahun'));
    }

    protected function dashBoardLevel4(){
      $tahun = date('Y');
      $usulan     = Usulan::where('tahun', '=', $tahun)
          ->whereNotNull('tgl_kirim')
          ->count('id_usulan'); 

      $telaah     = Telaah::join('usulan', 'usulan.id_usulan', '=', 'telaah.id_usulan')
          ->where('usulan.tahun', '=', $tahun)
          ->whereNotNull('telaah.tgl_kirim')
          ->count('telaah.id_telaah'); 
      
      $sp     = Sp::where('tahun', '=', $tahun)
          ->whereNotNull('tgl_kirim_sp')
          ->where('status_sp', '=', 'Aktif')
          ->count('sp.id_sp'); 
      
      $usulanPie = Usulan::whereNotNull('tgl_kirim')
      ->select(DB::raw('count(id_usulan) as jumUsulanPie'), 'tahun')
      ->groupBy('tahun')
      ->get();

      $telaahPie     = Telaah::join('usulan', 'usulan.id_usulan', '=', 'telaah.id_usulan')
          ->select(DB::raw('count(*) as jumTelaahPie'), 'usulan.tahun')
          ->whereNotNull('telaah.tgl_kirim')
          ->groupBy('usulan.tahun')
          ->get(); 
      
      $spPie     = Sp::select(DB::raw('count(*) as jumSpPie'), 'sp.tahun')
          ->whereNotNull('tgl_kirim_sp')
          ->where('status_sp', '=', 'Aktif')
          ->groupBy('sp.tahun')
          ->get();

      return view('admin.dashboard.index.mainspp',compact('usulan','telaah', 'sp', 'tahun', 'usulanPie', 'telaahPie', 'spPie'));
    }

    protected function dashboardLevel5(){
      $user = Auth::user();
        $tahun  = date('Y');
        if($user->level === 2) {
            $usulan     = Usulan::where('tahun', '=', $tahun)
                ->where('id_unit_kerja', '=', $user->id_unit_kerja)
                ->count('id_usulan'); 
        } else {
            $usulan     = Usulan::where('tahun', '=', $tahun)
                ->whereNotNull('tgl_kirim')
                ->count('id_usulan'); 

            $telaah     = Telaah::join('usulan', 'usulan.id_usulan', '=', 'telaah.id_usulan')
                ->where('usulan.tahun', '=', $tahun)
                ->whereNotNull('telaah.tgl_kirim')
                ->count('telaah.id_telaah'); 
            
            $sp     = Sp::where('tahun', '=', $tahun)
                ->whereNotNull('tgl_kirim_sp')
                ->where('status_sp', '=', 'Aktif')
                ->count('sp.id_sp'); 
        }

        // return response()->json($sp);
        return view('admin.dashboard.index.mainmanajemen',compact('usulan','telaah', 'sp', 'tahun'));
    }
    
}

