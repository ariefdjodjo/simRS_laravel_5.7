<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RkaklKomponen extends Model
{
    protected $table = "rkakl_komponen";
    public $timestamps = false;
	protected $primaryKey = 'id_komponen';

    protected $fillable = ['id_komponen', 'kode_komponen', 'uraian_komponen'];
}
