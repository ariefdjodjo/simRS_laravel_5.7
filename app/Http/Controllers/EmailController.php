<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Email as Email;

class EmailController extends Controller
{
    public function index() {
        $level = Auth::user()->level;
        $data = DB::table('ref_email')->where('level_user', '=', $level)->first();

        return view('admin.dashboard.user.email', compact('data', 'level'));
    }

    public function edit(request $request){
        $data = Email::find($request->id);
        $data->alamat_email = $request->alamat_email;
        $data->update();

        return Redirect('email'); 
    }
}
