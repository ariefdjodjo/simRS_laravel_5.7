<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
//use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;



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
      return view('admin.dashboard.index.mainadmin');
    }

    protected function dashBoardLevel2(){
      return view('admin.dashboard.index.mainpengusul');
    }

    protected function dashBoardLevel3(){
      return view('admin.dashboard.index.maintelaah');
    }

    protected function dashBoardLevel4(){
      return view('admin.dashboard.index.mainspp');
    }

    protected function dashboardLevel5(){
      return view('admin.dashboard.index.mainmanajemen');
    }
    
}

