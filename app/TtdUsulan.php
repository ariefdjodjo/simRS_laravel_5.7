<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TtdUsulan extends Model
{
    protected $table = "ref_ttd_usulan";
	public $timestamps = false;
	protected $primaryKey = 'id_ttd_usulan';

    protected $fillable = ['id_unit_kerja','nama_kepala', 'nip_kepala', 'jabatan', 'status'];

    public function mstUnitKerja() {
    	return $this->hasMany('App\\MstUnitKerja', 'id_unit_kerja', 'id_unit_kerja');
    }

    public function usulan(){
        return $this->hasMany('App\\Usulan', 'id_ttd_usulan', 'pengirim_usulan');
    }
}
