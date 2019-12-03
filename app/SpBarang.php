<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpBarang extends Model
{
    protected $table = "sp_barang";
	public $timestamps = true;
	protected $primaryKey = 'id_barang_sp';

    protected $fillable = [
        'id_sp', 
        'id_barang_usulan', 
        'nama_barang_sp', 
        'spesifikasi_barang_sp', 
        'satuan_sp', 
        'qty_sp', 
        'harga_satuan_sp'
    ];

    public function sp(){
        return $this->belongsTo('App\\Sp', 'id_sp', 'id_sp');
    }
}
