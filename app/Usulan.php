<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    protected $table = "usulan";
    public $timestamps = true;
    protected $primaryKey = "id_usulan";

    protected $fillable = ['id', 'id_unit_kerja', 'no_usulan', 'tgl_usulan', 'perihal_usulan', 'jenis_usulan', 'isi_usulan', 'pengirim_usulan', 'tgl_kirim', 'dibaca'];

    public function unitKerja(){
        return $this->belongsTo('App\\MstUnitKerja', 'id_unit_kerja', 'id_unit_kerja');
    }

    public function barangUsulan(){
        return $this->hasMany('App\\UsulanBarang', 'id_usulan', 'id_usulan');
    }

    public function lampiranUsulan(){
        return $this->hasMany('App\\UsulanLampiran', 'id_usulan', 'id_usulan');
    }

    public function pengirim(){
        return $this->belongsTo('App\\TtdUsulan', 'pengirim_usulan', 'id_ttd_usulan');
    }
}

