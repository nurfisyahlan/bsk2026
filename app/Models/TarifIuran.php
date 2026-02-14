<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarifIuran extends Model
{
    protected $table = 'tarif_iuran';

    protected $fillable = [
        'tahun_mulai',
        'nominal',
    ];

    /**
     * Ambil tarif yang berlaku untuk tahun tertentu
     */
    public static function tarifUntukTahun(int $tahun): int
    {
        $tarif = self::where('tahun_mulai', '<=', $tahun)
            ->orderBy('tahun_mulai', 'desc')
            ->first();

        return $tarif?->nominal ?? 0;
    }
}
