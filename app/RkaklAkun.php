<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RkaklAkun extends Model
{
    protected $table = "rkakl_akun";
    public $timestamps = false;
	protected $primaryKey = 'id_akun';

    protected $fillable = ['id_akun', 'tahun', 'kode_akun', 'uraian_akun', 'sumber_dana'];
}
