<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telaah extends Model
{
    protected $table = "telaah";
	public $timestamps = true;
	protected $primaryKey = 'id_telaah';

    protected $fillable = ['id_usulan', 'no_telaah', 'tgl_telaah', 'penandatangan', 'analisis_kebutuhan', 'alasan_kebutuhan', 'urgency', 'tgl_kirim', 'tgl_baca'];

    public function queryTelaah($id) {
        $data = DB::table('telaah')
        ->join('usulan', 'telaah.id_usulan', '=', 'usulan.id_usulan')
        ->join('mst_unit_kerja', 'usulan.id_unit_kerja', '=', 'mst_unit_kerja.id_unit_kerja')
        ->join('ref_ttd_usulan', 'usulan.pengirim_usulan', '=', 'ref_ttd_usulan.id_ttd_usulan')
        ->join('ref_ttd_telaah', 'telaah.penandatangan', '=', 'ref_ttd_telaah.id_ttd_telaah')
        ->where('telaah.id_usulan', '=', $id)
        ->first();

        return $data;
    }

    public function usulan(){
        return $this->belongsTo('App\\Usulan', 'id_usulan', 'id_usulan')->with('unitKerja', 'barangUsulan', 'lampiranUsulan');
    }

    public function ttd(){
        return $this->belongsTo('App\\TtdTelaah', 'penandatangan', 'id_ttd_telaah');
    }
}
