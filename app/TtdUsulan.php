<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TtdUsulan extends Model
{
    protected $table = "ref_ttd_usulan";
	public $timestamps = false;
	protected $primaryKey = 'id_ttd_usulan';

    protected $fillable = ['id_unit_kerja','nama_kepala', 'nip_kepala', 'jabatan', 'status'];

    public function MstUnitKerja() {
    	return $this->hasMany('App\MstUnitKerja');
    }
}
