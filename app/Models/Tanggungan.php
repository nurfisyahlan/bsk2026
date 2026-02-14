<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggungan extends Model
{
    use HasFactory;

    protected $table = 'tanggungan';

    protected $fillable = [
        'no_bsk',
        'nama_tanggungan',
        'hubungan',
        'status',
    ];

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'no_bsk', 'no_bsk');
    }
}