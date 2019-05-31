<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsulanBarang extends Model
{
    protected $table = "usulan_barang";
    public $timestamps = false;
    protected $primaryKey = "id_barang_usulan";

    protected $fillable = ['id_barang_usulan', 'id_usulan', 'nama_barang', 'spesifikasi', 'satuan', 'harga_usulan', 'jumlah_usulan', 'catatan_usulan', 'qty_telaah', 'harga_telaah', 'jumlah_harga_telaah', 'dasar_harga', 'catatan_kebutuhan', 'status_barang_telaah'];
}
