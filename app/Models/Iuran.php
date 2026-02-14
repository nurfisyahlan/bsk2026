<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    use HasFactory;

    protected $table = 'iuran';

    protected $fillable = [
        'no_bsk',
        'tahun',
        'status',
    ];

    /**
     * Relasi: Iuran milik satu keluarga
     */
    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'no_bsk', 'no_bsk');
    }

    /**
     * Relasi: Iuran punya banyak detail (pembayaran bulanan)
     */
    public function detail()
    {
        return $this->hasMany(IuranDetail::class, 'iuran_id');
    }

    /**
     * Helper: cek apakah sudah lunas
     */
    public function isLunas(): bool
    {
        return $this->status === 'sudah_lunas';
    }
}
