<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RkaklKegiatan extends Model
{
    protected $table = "rkakl_kegiatan";
    public $timestamps = false;
	protected $primaryKey = 'id_kegiatan';

    protected $fillable = ['id_kegiatan', 'tahun', 'kode_output', 'uraian_kegiatan'];

    public function RkaklTahun() {
    	return $this->belongTo('App\RkaklTahun');
    }
}
