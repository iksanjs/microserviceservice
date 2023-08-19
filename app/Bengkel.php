<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bengkel extends Model
{
    protected $table = 'bengkels';
    protected $primaryKey = 'id_bengkel';
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['nama_bengkel', 'jenis_bengkel', 'alamat_bengkel', 'nomor_telepon', 'approval', 'keterangan'];
}
