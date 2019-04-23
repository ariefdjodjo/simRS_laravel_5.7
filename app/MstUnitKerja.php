<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstUnitKerja extends Model
{
    protected $table = "mst_unit_kerja";
	public $timestamps = false;
	protected $primaryKey = 'id_unit_kerja';

    protected $fillable = ['nama_unit_kerja', 'no_telp', 'email_unit_kerja', 'kode_agenda_satker'];

    public function ttdUsulan(){
    	return $this->belongTo('App\TtdUsulan');
    }
}
