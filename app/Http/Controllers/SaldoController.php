<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use Illuminate\Http\Request;

class SaldoController extends Controller
{    
    
    public function index()
    {
        $saldoList = Saldo::orderBy('tanggal')
            ->orderBy('id')
            ->get();

            $saldoTerkini = 0;

            foreach ($saldoList as $s) {
                if ($s->jenis === 'Masuk') {
                    $saldoTerkini += $s->jumlah;
                } else {
                    $saldoTerkini -= $s->jumlah;
                }
            }

        return view('saldo.index', compact('saldoList','saldoTerkini'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:Masuk,Keluar',
            'uraian' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        Saldo::create($request->all());

        return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $saldo = Saldo::findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:Masuk,Keluar',
            'jumlah' => 'required|integer|min:1',
            'uraian' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        // proteksi saldo minus (exclude data yg sedang diedit)
        if ($request->jenis === 'Keluar') {
            $masuk = Saldo::where('jenis', 'Masuk')->sum('jumlah');
            $keluar = Saldo::where('jenis', 'Keluar')
                ->where('id', '!=', $saldo->id)
                ->sum('jumlah');

            $saldoTerkini = $masuk - $keluar;

            if ($request->jumlah > $saldoTerkini) {
                return back()->withErrors([
                    'jumlah' => 'Saldo tidak mencukupi'
                ]);
            }
        }

        $saldo->update($request->all());

        return back()->with('success', 'Data saldo berhasil diperbarui');
    }

    public function destroy($id)
    {
        Saldo::findOrFail($id)->delete();
        return back()->with('success', 'Data saldo berhasil dihapus');
    }


}
