<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Saldo;
use App\Models\Inventaris;
use App\Models\Tanggungan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKeluarga   = Keluarga::count();
        $totalJiwa       = Tanggungan::count(); // 🔥 FIX UTAMA
        $totalSaldo      = Saldo::sum('jumlah');
        $totalInventaris = Inventaris::count();

        return view('dashboard.index', compact(
            'totalKeluarga',
            'totalJiwa',
            'totalSaldo',
            'totalInventaris'
        ));
    }
}
