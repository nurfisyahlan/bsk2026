@extends('layouts.app')

@section('title', 'Data Pengumuman')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h3>Data Pengumuman</h3>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-2">Kembali ke Dashboard</a>
</div>

<button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
    + Tambah Pengumuman
</button>

@if(session('success'))
    <script>alert("{{ session('success') }}");</script>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Judul</th>
            <th class="text-center">Isi</th>
            <th class="text-center">Gambar</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengumuman as $row)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td class="text-center">{{ $row->tanggal }}</td>
            <td>{{ $row->judul_pengumuman }}</td>
            <td>{{ Str::limit($row->isi_pengumuman, 50) }}</td>
            <td class="text-center">
                @if($row->gambar)
                    <img src="{{ asset('storage/'.$row->gambar) }}" width="80">
                @else
                    <span class="text-muted fst-italic">Tidak ada gambar</span>
                @endif
            </td>
            <td class="text-center">
                    <button class="btn btn-info btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#modalDetail{{ $row->id }}">
                    <i class="bi bi-info-circle"></i>
                </button>
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modalEdit{{ $row->id }}"><i class="bi bi-pencil-square"></i></button>

                <form action="{{ route('pengumuman.destroy', $row->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus pengumuman ini?')"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>

        {{-- ================= MODAL EDIT PENGUMUMAN ================= --}}
        <div class="modal fade" id="modalEdit{{ $row->id }}" tabindex="-1"
            aria-labelledby="modalEditLabel{{ $row->id }}" aria-hidden="true">

            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <form action="{{ route('pengumuman.update', $row->id) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="modal-content">

                        {{-- HEADER --}}
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="modalEditLabel{{ $row->id }}">
                                Edit Pengumuman
                            </h5>
                            <button type="button" class="btn-close"
                                    data-bs-dismiss="modal"></button>
                        </div>

                        {{-- BODY --}}
                        <div class="modal-body">

                            {{-- TANGGAL --}}
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date"
                                    name="tanggal"
                                    class="form-control"
                                    value="{{ $row->tanggal }}"
                                    required>
                            </div>

                            {{-- JUDUL --}}
                            <div class="mb-3">
                                <label class="form-label">Judul Pengumuman</label>
                                <input type="text"
                                    name="judul_pengumuman"
                                    class="form-control"
                                    value="{{ $row->judul_pengumuman }}"
                                    required>
                            </div>

                            {{-- ISI --}}
                            <div class="mb-3">
                                <label class="form-label">Isi Pengumuman</label>
                                <textarea name="isi_pengumuman"
                                        class="form-control"
                                        rows="5"
                                        required>{{ $row->isi_pengumuman }}</textarea>
                            </div>

                            {{-- GAMBAR SAAT INI --}}
                            @if ($row->gambar)
                                <div class="mb-3">
                                    <label class="form-label d-block">Gambar Saat Ini</label>
                                    <img src="{{ asset('storage/'.$row->gambar) }}"
                                        class="img-fluid rounded shadow-sm mb-2"
                                        style="max-height: 220px">

                                    <div class="form-check mt-2">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="hapus_gambar"
                                            value="1"
                                            id="hapusGambar{{ $row->id }}">
                                        <label class="form-check-label"
                                            for="hapusGambar{{ $row->id }}">
                                            Hapus gambar ini
                                        </label>
                                    </div>
                                </div>
                            @endif

                            {{-- GANTI GAMBAR --}}
                            <div class="mb-3">
                                <label class="form-label">Ganti Gambar (opsional)</label>
                                <input type="file"
                                    name="gambar"
                                    class="form-control"
                                    accept="image/*">
                                <small class="text-muted">
                                    Kosongkan jika tidak ingin mengganti gambar
                                </small>
                            </div>

                        </div>

                        {{-- FOOTER --}}
                        <div class="modal-footer">
                            <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit"
                                    class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        {{-- ========================================================= --}}

        @endforeach
    </tbody>
</table>

{{-- MODAL DETAIL --}}
<div class="modal fade" id="modalDetail{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detail Pengumuman</h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>
                    <strong>Tanggal:</strong><br>
                    {{ \Carbon\Carbon::parse($row->tanggal)->translatedFormat('d F Y') }}
                </p>

                <p>
                    <strong>Judul Pengumuman:</strong><br>
                    {{ $row->judul_pengumuman }}
                </p>

                <hr>

                <p>
                    <strong>Isi Pengumuman:</strong>
                </p>
                <div class="border rounded p-3 bg-light">
                    {{ $row->isi_pengumuman }}
                </div>

                @if($row->gambar)
                <hr>
                <p><strong>Gambar:</strong></p>
                <img src="{{ asset('storage/'.$row->gambar) }}"
                    class="img-fluid rounded"
                    style="max-height:300px">
                @endif
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Judul</label>
                        <input type="text" name="judul_pengumuman" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Isi</label>
                        <textarea name="isi_pengumuman" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
