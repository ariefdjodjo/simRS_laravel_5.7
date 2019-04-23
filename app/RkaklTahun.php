<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RkaklTahun extends Model
{
    protected $table = "rkakl_tahun";
    public $timestamps = false;
	protected $primaryKey = 'tahun';

    protected $fillable = ['tahun', 'kode_program', 'uraian_program'];
}
