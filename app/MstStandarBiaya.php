<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstStandarBiaya extends Model
{
    protected $table = "ref_standart_biaya";
    public $timestamps = true;
    protected $primaryKey = "id_kebutuhan_barang";

    protected $fillable = ['tahun', 'id_master_barang', 'barang_tersedia', 'kebutuhan', 'harga_satuan', 'dasar_harga', 'lampiran'];
}
