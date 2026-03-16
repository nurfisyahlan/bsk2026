<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\Saldo;
use App\Models\Inventaris;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if ($username == 'admin' && $password == '1234') {

            session(['admin_login' => true]);

            return redirect()->route('admin.index');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function index()
    {
        $totalKeluarga   = Keluarga::count();
        $totalJiwa       = Keluarga::sum('jiwa');
        $totalSaldo      = Saldo::sum('jumlah');
        $totalInventaris = Inventaris::count();

        return view('dashboard.index', compact(
            'totalKeluarga',
            'totalJiwa',
            'totalSaldo',
            'totalInventaris'
        ));
    }

    public function logout()
    {
        session()->forget('admin_login');

        return redirect()->route('admin.login');
    }
}