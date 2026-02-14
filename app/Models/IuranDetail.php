<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IuranDetail extends Model
{
    use HasFactory;

    protected $table = 'iuran_detail';

    protected $fillable = [
        'iuran_id',
        'bulan',
        'tanggal_bayar',
        'nominal',
    ];

    /**
     * Relasi: detail milik satu iuran
     */
    public function iuran()
    {
        return $this->belongsTo(Iuran::class);
    }
}
