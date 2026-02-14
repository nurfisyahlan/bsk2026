<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Tanggungan;
use Illuminate\Http\Request;

class TanggunganController extends Controller
{
    // =========================
    // FORM TAMBAH TANGGUNGAN
    // =========================
    public function create(string $no_bsk)
    {
        $keluarga = Keluarga::findOrFail($no_bsk);
        return view('tanggungan.create', compact('keluarga'));
    }

    // =========================
    // SIMPAN TANGGUNGAN
    // =========================
    public function store(Request $request, string $no_bsk)
    {
        $request->validate([
            'nama_tanggungan'   => 'required|array',
            'nama_tanggungan.*' => 'required|string',
            'hubungan'          => 'required|array',
            'hubungan.*'        => 'required|string',
            'status'            => 'required|array',
            'status.*'          => 'required|in:Hidup,Meninggal',
        ]);

        foreach ($request->nama_tanggungan as $i => $nama) {
            Tanggungan::create([
                'no_bsk'          => $no_bsk,
                'nama_tanggungan' => $nama,
                'hubungan'        => $request->hubungan[$i],
                'status'          => $request->status[$i],
            ]);
        }

        return redirect()
            ->route('keluarga.detail', $no_bsk)
            ->with('success', 'Data tanggungan berhasil ditambahkan.');
    }

    // =========================
    // FORM EDIT TANGGUNGAN
    // =========================
    public function edit(string $no_bsk, int $id)
    {
        $keluarga   = Keluarga::findOrFail($no_bsk);
        $tanggungan = Tanggungan::findOrFail($id);

        return view('tanggungan.edit', compact('keluarga', 'tanggungan'));
    }

    // =========================
    // UPDATE TANGGUNGAN
    // =========================
    public function update(Request $request, string $no_bsk, int $id)
    {
        $request->validate([
            'nama_tanggungan' => 'required|string',
            'hubungan'        => 'required|string',
            'status'          => 'required|in:Hidup,Meninggal',
        ]);

        $tanggungan = Tanggungan::findOrFail($id);

        $tanggungan->update([
            'nama_tanggungan' => $request->nama_tanggungan,
            'hubungan'        => $request->hubungan,
            'status'          => $request->status,
        ]);

        return redirect()
            ->route('keluarga.detail', $no_bsk)
            ->with('success', 'Data tanggungan berhasil diperbarui.');
    }

    // =========================
    // HAPUS TANGGUNGAN
    // =========================
    public function destroy(string $no_bsk, int $id)
    {
        $tanggungan = Tanggungan::findOrFail($id);
        $tanggungan->delete();

        return redirect()
            ->route('keluarga.detail', $no_bsk)
            ->with('success', 'Data tanggungan berhasil dihapus.');
    }
}
