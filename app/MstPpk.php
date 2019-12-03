<?php

namespace App;

use App\Helpers;
use Illuminate\Database\Eloquent\Model;

class MstPpk extends Model
{
    protected $table        = "mst_ppk";
    public $timestamps      = false;
    protected $primaryKey   = "id_ppk";

    protected $fillable     = ['nama_ppk', 'nip_ppk', 'jabatan_ppk', 'dasar_ppk', 'awal_berlaku', 'akhir_berlaku', 'status_ppk'];
}
