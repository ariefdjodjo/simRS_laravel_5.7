<?php

namespace App\Http\Controllers\Auth;

use App\User as User;
use App\Helpers\level;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use App\MstUnitKerja as MstUnitKerja;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('level:1');
    }

    protected function index() {
        $data = DB::table('users')
            ->leftjoin('mst_unit_kerja', 'mst_unit_kerja.id_unit_kerja', '=', 'users.id_unit_kerja')
            ->get();
        $listMstUnitKerja = MstUnitKerja::all();
        return view('admin.dashboard.user.data',compact('data', 'listMstUnitKerja')); 

    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'id_unit_kerja' =>['required', 'string', 'max:5'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'username' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:3'],
        ]);
    }

    protected function register() {
        $listMstUnitKerja = MstUnitKerja::all();
        return view('auth.register',compact('listMstUnitKerja'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'id_unit_kerja' => $data['id_unit_kerja'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'username' => $data['username'],
            'level' => $data['level'],
            'status'=> $data['status'],
        ]);
    }

    protected function regUser(request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->id_unit_kerja = $request->id_unit_kerja;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->username = $request->username;
        $user->level = $request->level;
        $user->save();
        
        return Redirect('user/data');
    }

    
}
