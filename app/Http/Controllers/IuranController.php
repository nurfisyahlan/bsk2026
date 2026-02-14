<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Keluarga;
use App\Models\IuranDetail;
use App\Models\TarifIuran;
use Illuminate\Http\Request;

class IuranController extends Controller
{
    /**
     * Tampilkan daftar iuran
     */
    public function index(Request $request)
    {
        // default tahun = tahun sekarang
        $tahunDipilih = $request->tahun ?? date('Y');
        $status = $request->status;
        $rtRw = $request->rt_rw;

        // query utama iuran
        $query = Iuran::with(['keluarga', 'detail'])
            ->where('tahun', $tahunDipilih);

        // filter status (sudah_lunas / belum_lunas)
        if ($status) {
            $query->where('status', $status);
        }

        // filter RT/RW (relasi ke tabel keluarga)
        if ($rtRw) {
            $query->whereHas('keluarga', function ($q) use ($rtRw) {
                $q->where('rt_rw', $rtRw);
            });
        }

        $iuran = $query
            ->orderBy('tahun', 'desc')
            ->get();

        // list tahun untuk dropdown
        $listTahun = Iuran::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // list keluarga (untuk modal create)
        $keluarga = Keluarga::orderBy('nama_kk')->get();

        // list RT/RW untuk filter
        $listRtRw = Keluarga::select('rt_rw')
            ->distinct()
            ->orderBy('rt_rw')
            ->pluck('rt_rw');

        // 👉 VIEW TETAP SAMA
        return view('iuran.index', compact(
            'iuran',
            'keluarga',
            'listTahun',
            'tahunDipilih',
            'listRtRw'
        ));
    }

    /**
     * Form catat iuran
     */
    public function create()
    {
        $keluarga = Keluarga::orderBy('nama_kk')->get();

        return view('iuran.create', compact('keluarga'));
    }

    /**
     * Simpan pembayaran iuran per bulan (SUDAH PUNYAMU)
     */
    public function storeBulanan(Request $request)
    {
        $request->validate([
            'no_bsk' => 'required|exists:keluarga,no_bsk',
            'tahun'  => 'required|integer',
            'bulan'  => 'nullable|array', // boleh kosong (kalau cuma edit tanggal)
        ]);

        // 1. SATU IURAN PER TAHUN
        $iuran = Iuran::firstOrCreate(
            [
                'no_bsk' => $request->no_bsk,
                'tahun'  => $request->tahun,
            ],
            ['status' => 'belum_lunas']
        );

        // 2. AMBIL TARIF
        $tarif = TarifIuran::tarifUntukTahun((int) $request->tahun);

        // =====================================================
        // 3. TAMBAH BULAN BARU (CHECKBOX)
        // =====================================================
        if ($request->filled('bulan')) {
            foreach ($request->bulan as $bulan) {
                IuranDetail::updateOrCreate(
                    [
                        'iuran_id' => $iuran->id,
                        'bulan'    => $bulan,
                    ],
                    [
                        'tanggal_bayar' => now(),
                        'nominal'       => $tarif,
                    ]
                );
            }
        }

        // =====================================================
        // 4. EDIT TANGGAL PEMBAYARAN (FITUR BARU)
        // =====================================================
        if ($request->filled('tanggal_edit')) {
            foreach ($request->tanggal_edit as $bulan => $tanggal) {
                IuranDetail::where('iuran_id', $iuran->id)
                    ->where('bulan', $bulan)
                    ->update([
                        'tanggal_bayar' => $tanggal,
                    ]);
            }
        }

        // =====================================================
        // 5. AUTO UPDATE STATUS LUNAS
        // =====================================================
        if ($iuran->detail()->count() >= 12) {
            $iuran->update(['status' => 'sudah_lunas']);
        } else {
            $iuran->update(['status' => 'belum_lunas']);
        }

        return redirect()
            ->route('iuran.index', ['tahun' => $request->tahun])
            ->with('success', 'Pembayaran iuran berhasil disimpan');
    }


    /**
     * Detail iuran per tahun
     */
    public function show(Iuran $iuran)
    {
        $iuran->load('keluarga', 'detail');

        return view('iuran.show', compact('iuran'));
    }

    /**
     * Hapus iuran (cascade ke detail)
     */
    public function destroy(Iuran $iuran)
    {
        $iuran->delete();

        return redirect()
            ->route('iuran.index')
            ->with('success', 'Data iuran berhasil dihapus');
    }


}
