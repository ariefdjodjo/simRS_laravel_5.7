<?php

namespace App\Http\Controllers;

use App\User as User;
use App\MstUnitKerja as MstUnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Auth;

class UserController extends Controller
{
	public function index() {
		//
	}

	public function setStatus(request $request, $id) {
		//set Aktif user
		$user = User::find($id);
		$user->status = $request->status;
		$user->update();

		return Redirect('user/data');
		
	}

	public function edit(request $request, $id) {
		$user 	= User::find($id);
		$user->name = $request->name;
        $user->id_unit_kerja = $request->id_unit_kerja;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->level = $request->level;
        $user->update();

        return Redirect('user/data');
	}

	public function delete($id) {
		$user = User::WHERE('id', '=', $id);
        if($user == null) 
            app::abort(404);
        $user->delete();

        return Redirect('user/data');
	}

	protected function ubahPassword(request $request, $id) {
		
			$user 	= User::find($id);
			$user->password = Hash::make($request->password);
			$user->update();

			return Redirect('user/data');
		
	}

	public function profile() {
		$user = User::find(Auth::User()->id);
		$unit = MstUnitKerja::find(Auth::User()->id_unit_kerja);

		return view('admin.dashboard.user.profile', compact('user','unit'));
	}
}
