<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = 'inventaris';

    protected $fillable = [
        'nama_item',
        'jenis',
        'jumlah',
        'status',
        'tanggal_diperoleh',
        'keterangan',
    ];
}
