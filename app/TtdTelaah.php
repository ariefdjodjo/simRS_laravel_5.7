<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TtdTelaah extends Model
{
    protected $table = "ref_ttd_telaah";
	public $timestamps = false;
	protected $primaryKey = 'id_ttd_telaah';

    protected $fillable = ['nama_penelaah', 'nip_penelaah', 'jabatan', 'file_ttd', 'status'];

}
