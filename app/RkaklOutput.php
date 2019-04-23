<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class RkaklOutput extends Model
{
    protected $table = "rkakl_output";
    public $timestamps = false;
	protected $primaryKey = 'id_output';

    protected $fillable = ['id_output', 'kode_output', 'uraian_output'];
}
