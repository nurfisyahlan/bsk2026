<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $table = 'keluarga';

    protected $primaryKey = 'no_bsk';
    public $incrementing = false;
    public $keyType = 'string';


    protected $fillable = [
        'no_bsk',
        'nama_kk',
        'alamat',
        'rt_rw',
        'status',
        'keterangan',
    ];
    
    public function getRouteKeyName()
    {
        return 'no_bsk';
    }

    public function tanggungan()
    {
        return $this->hasMany(Tanggungan::class, 'no_bsk', 'no_bsk');
    }

    public function getJiwaAttribute()
    {        
        return $this->tanggungan()
        ->where('status', 'Hidup')
        ->count();
    }
    

    
}

