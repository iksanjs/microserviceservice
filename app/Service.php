<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id_service';

    protected $fillable = [
        'no_polisi',
        'id_kontraksewa',
        'id_bengkel',
        'km',
        'km_selanjutnya',
        'jenis_service',
        'tanggal_penerima_service',
        'tanggal_penyerahan_service',
        'sparepart',
        'harga',
        'qty',
        'keterangan_sparepart',
        'harga_jasa',
        'total_harga_service',
        'approval',
        'keterangan',
    ];

    // public function bengkel()
    // {
    //     return $this->belongsTo(Bengkel::class, 'id_bengkel', 'id_bengkel');
    // }
}
