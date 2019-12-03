<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sp extends Model
{
    protected $table = "sp";
	public $timestamps = true;
	protected $primaryKey = 'id_sp';

    protected $fillable = [
        'id_telaah', 
        'tahun', 
        'no_sp', 
        'tgl_sp', 
        'hal_sp', 
        'id_sub_alokasi', 
        'status_sp', 
        'tgl_kirim_sp', 
        'revisi',
        'catatan_sp',
        'user_input',
        'penandatangan_sp'
    ];

    public function penandatangan(){
        return $this->belongsTo('App\\TtdSpp', 'penandatangan_sp', 'id_ttd_sp');
    }
    
    public function sA(){
        return $this->belongsTo('App\\RkaklSubAlokasi', 'id_sub_alokasi', 'id_sub_alokasi');
    }

    public function telaah(){
        return $this->belongsTo('App\\Telaah','id_telaah', 'id_telaah');
        //return $this->hasManyThrough('App\\Usulan', 'App\\Telaah', 'id_usulan', 'id_usulan', 'id_telaah');
    }

    public function barangSp(){
        return $this->hasMany('App\\SpBarang', 'id_sp', 'id_sp');
    }
}
