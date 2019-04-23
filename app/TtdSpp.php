<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TtdSpp extends Model
{
    protected $table = "ref_ttd_sp";
	public $timestamps = false;
	protected $primaryKey = 'id_ttd_sp';

    protected $fillable = ['nama_penandatangan', 'nip_penandatangan', 'jabatan', 'file_ttd', 'status'];

}
