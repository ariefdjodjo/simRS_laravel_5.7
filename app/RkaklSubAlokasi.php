<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RkaklSubAlokasi extends Model
{
    protected $table = "rkakl_sub_alokasi";
    public $timestamps = false;
	protected $primaryKey = 'id_sub_alokasi';

    protected $fillable = [
        'id_sub_alokasi', 
        'tahun', 
        'uraian_sub_alokasi',
        'kode_kl_satker',
        'id_kegiatan',
        'id_output',
        'id_sub_output',
        'id_komponen',
        'id_sub_komponen',
        'id_akun',
        'pagu_alokasi',
        'id_ppk'
    ];
}
