<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MstBarang extends Model
{
    protected $table        = "ref_master_barang";
    public $timestamps      = false;
    protected $primaryKey   = "id_master_barang";

    protected $fillable     = ['kode_jenis_barang', 'nama_barang', 'spesifikasi', 'satuan'];
}
