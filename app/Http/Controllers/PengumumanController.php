<?php
namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')->get();
        return view('pengumuman.index', compact('pengumuman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'judul_pengumuman' => 'required|string|max:255',
            'isi_pengumuman' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
        }

        Pengumuman::create($data);

        return redirect()->back()->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'judul_pengumuman' => 'required|string|max:255',
            'isi_pengumuman' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['hapus_gambar']);

        // HAPUS GAMBAR JIKA DICENTANG
        if ($request->has('hapus_gambar')) {
            if ($pengumuman->gambar) {
                Storage::disk('public')->delete($pengumuman->gambar);
            }
            $data['gambar'] = null;
        }

        // GANTI GAMBAR JIKA UPLOAD BARU
        if ($request->hasFile('gambar')) {
            if ($pengumuman->gambar) {
                Storage::disk('public')->delete($pengumuman->gambar);
            }
            $data['gambar'] = $request->file('gambar')
                                    ->store('pengumuman', 'public');
        }

        $pengumuman->update($data);

        return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui');
    }


    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        if ($pengumuman->gambar) {
            Storage::disk('public')->delete($pengumuman->gambar);
        }

        $pengumuman->delete();

        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus');
    }
}
?>