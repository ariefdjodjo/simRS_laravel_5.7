<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\MstUnitKerja as MstUnitKerja;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'level', 'id_unit_kerja', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();
        
        if(is_array($roles)){
            foreach($roles as $need_role){
                if($this->cekUserRole($need_role)) {
                    return true;
                }
            }
        } else{
            return $this->cekUserRole($roles);
        }
        return false;
    }
    private function getUserRole()
    {
       return $this->role()->getResults();
    }
    
    private function cekUserRole($role)
    {
        return (strtolower($role)==strtolower($this->have_role->nama)) ? true : false;
    }

    public function unitKerja() {
        return $this->belongsTo('App\\MstUnitKerja', 'id_unit_kerja', 'id_unit_kerja');
    }
}
