<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RkaklSubOutput extends Model
{
    protected $table = "rkakl_sub_output";
    public $timestamps = false;
	protected $primaryKey = 'id_sub_output';

    protected $fillable = ['id_sub_output', 'kode_sub_output', 'uraian_sub_output'];
}
