<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsulanLampiran extends Model
{
    protected $table = "usulan_lampiran";
    public $timestamps = false;
    protected $primaryKey = "id_lampiran_usulan";

    protected $fillable = ['id_lampiran_usulan', 'id_usulan', 'nama_dokumen', 'link_file'];
}
