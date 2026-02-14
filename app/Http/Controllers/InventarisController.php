<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris::latest()->get();
        return view('inventaris.index', compact('inventaris'));
    }

    public function create()
    {
        return view('inventaris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_item' => 'required|string|max:255',
            'jenis' => 'required|in:Peralatan Utama,Peralatan Pendukung',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:Bagus,Rusak,Hilang',
            'tanggal_diperoleh' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Inventaris::create($request->all());

        return redirect()->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil ditambahkan');
    }

    public function edit($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        return view('inventaris.edit', compact('inventaris'));
    }

    public function update(Request $request, $id)
    {
        $inventaris = Inventaris::findOrFail($id);

        $request->validate([
            'nama_item' => 'required|string|max:255',
            'jenis' => 'required|in:Peralatan Utama,Peralatan Pendukung',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:Bagus,Rusak,Hilang',
            'tanggal_diperoleh' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);


        $inventaris->update($request->all());

        return redirect()->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil diperbarui');
    }

    public function destroy($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        $inventaris->delete();

        return redirect()->route('inventaris.index')
            ->with('success', 'Data inventaris berhasil dihapus');
    }
}
