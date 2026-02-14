<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use Illuminate\Http\Request;
use App\Models\Tanggungan;
use Illuminate\Support\Facades\DB;


class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keluarga = Keluarga::all();
        return view('keluarga.index', compact('keluarga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('keluarga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_bsk'   => 'required|string|unique:keluarga,no_bsk',
            'nama_kk'  => 'required|string',
            'alamat'   => 'required|string',
            'rt_rw'    => 'required|in:RT 01/RW 04,RT 02/RW 04,RT 03/RW 04,RT 03/RW 03,RW 05 PB,RT/RW Luar',
            'status'   => 'required|in:Aktif,Nonaktif',
            'keterangan' => 'nullable|string',
        ]);

        // 1️⃣ Simpan data keluarga
        $keluarga = Keluarga::create([
            'no_bsk'     => $request->no_bsk,
            'nama_kk'    => $request->nama_kk,
            'alamat'     => $request->alamat,
            'rt_rw'      => $request->rt_rw,
            'status'     => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        // 2️⃣ OTOMATIS TAMBAH KEPALA KELUARGA KE TABEL TANGGUNGAN
        Tanggungan::create([
            'no_bsk'          => $keluarga->no_bsk,
            'nama_tanggungan' => $keluarga->nama_kk,
            'hubungan'        => 'Kepala Keluarga',
            'status'          => 'Hidup',
        ]);

        return redirect()
            ->route('keluarga.index')
            ->with('success', 'Data keluarga berhasil ditambahkan.');
    }


    // GET /keluarga/{no_bsk}    
    public function detail(string $no_bsk)
    {
        $keluarga = Keluarga::with('tanggungan')->findOrFail($no_bsk);
        return view('keluarga.detail', compact('keluarga'));
    }

    // GET /keluarga/{no_bsk}/edit
    public function edit(string $no_bsk)
    {
        $keluarga = Keluarga::findOrFail($no_bsk);
        return view('keluarga.edit', compact('keluarga'));
    }

    // PUT /keluarga/{no_bsk}
    public function update(Request $request, string $no_bsk)
    {
        $keluarga = Keluarga::findOrFail($no_bsk);

        $request->validate([
            'nama_kk' => 'required|string',
            'alamat' => 'required|string',
            'rt_rw' => 'required|in:RT 01/RW 04,RT 02/RW 04,RT 03/RW 04,RT 03/RW 03,RW 05 PB,RT/RW Luar',
            'status' => 'required|in:Aktif,Nonaktif',
            'keterangan' => 'nullable|string',            
        ]);

        $keluarga->update($request->except('jiwa'));

        return redirect()->route('keluarga.index')
                         ->with('success', 'Data keluarga berhasil diperbarui.');
    }

    // DELETE /keluarga/{no_bsk}
    public function destroy(string $no_bsk)
    {
        $keluarga = Keluarga::findOrFail($no_bsk);
        $keluarga->delete();

        return redirect()->route('keluarga.index')
                         ->with('success', 'Data keluarga berhasil dihapus.');
    }
}
