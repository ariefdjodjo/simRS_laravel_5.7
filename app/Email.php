<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = "ref_email";
    public $timestamps = false;
    protected $primaryKey = "id_email";

    protected $fillable = ['level_user', 'alamat_email'];
}
