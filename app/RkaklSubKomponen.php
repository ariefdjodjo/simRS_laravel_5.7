<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RkaklSubKomponen extends Model
{
    protected $table = "rkakl_sub_komponen";
    public $timestamps = false;
	protected $primaryKey = 'id_sub_komponen';

    protected $fillable = ['id_sub_komponen', 'kode_sub_komponen', 'uraian_sub_komponen'];
}
