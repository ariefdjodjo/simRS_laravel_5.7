<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    protected $table = "usulan";
    public $timestamps = true;
    protected $primaryKey = "id_usulan";

    protected $fillable = ['id', 'id_unit_kerja', 'no_usulan', 'tgl_usulan', 'perihal_usulan', 'jenis_usulan', 'isi_usulan', 'pengirim_usulan', 'tgl_kirim', 'dibaca'];
}
