<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function dashboard()
    {
        if (!session('admin_login')) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard');
    }

    public function logout()
    {
        session()->forget('admin_login');

        return redirect()->route('admin.login');
    }
}