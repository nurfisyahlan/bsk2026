<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;

    protected $table = 'saldo';

    protected $fillable = [
        'tanggal',
        'jenis',
        'jumlah',
        'uraian',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
