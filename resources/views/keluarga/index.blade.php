@extends('layouts.app')

@section('title', 'Data Keluarga BSK')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h3 class="mb-3">Data Keluarga BSK</h3>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-2">Kembali ke Dashboard</a>
</div>

<button class="btn btn-success mb-3"
        data-bs-toggle="modal"
        data-bs-target="#modal-create">
    + Tambah Data
</button>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark text-center">
        <tr>
            <th>No BSK</th>
            <th class>Nama Kepala Keluarga</th>
            <th class="text-center">Alamat</th>
            <th class="text-center">RT/RW</th>
            <th class="text-center">Status</th>
            <th class="text-center">Jiwa</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($keluarga as $k)
            <tr>
                <td>{{ $k->no_bsk }}</td>
                <td>{{ $k->nama_kk }}</td>
                <td>{{ $k->alamat }}</td>
                <td class="text-center">{{ $k->rt_rw }}</td>
                <td class="text-center">{{ $k->status }}</td>
                <td class="text-center">{{ $k->jiwa }}</td>
                <td class="text-center">

                    <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-edit-{{ $k->no_bsk }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <form action="{{ route('keluarga.destroy', $k->no_bsk) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Yakin mau hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>

                    <a href="{{ route('keluarga.detail', $k->no_bsk) }}"
                       class="btn btn-info btn-sm">
                        <i class="bi bi-info-circle"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">
                    Belum ada data
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- ================= MODAL CREATE ================= --}}
<div class="modal fade" id="modal-create" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Keluarga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('keluarga.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label>No BSK</label>
                            <input type="text" name="no_bsk" class="form-control" required>
                        </div>

                        <div class="col-md-9">
                            <label>Nama Kepala Keluarga</label>
                            <input type="text" name="nama_kk" class="form-control" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>RT / RW</label>
                            <select name="rt_rw" class="form-select" required>
                                <option value="">-- Pilih RT/RW --</option>
                                @foreach ([
                                    'RT 01/RW 04',
                                    'RT 02/RW 04',
                                    'RT 03/RW 04',
                                    'RT 03/RW 03',
                                    'RW 05 PB',
                                    'RT/RW Luar'
                                ] as $rt)
                                    <option value="{{ $rt }}">{{ $rt }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Status</label>
                            <select name="status" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i> Batal
                    </button>
                    <button class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- ================= MODAL EDIT ================= --}}
@foreach ($keluarga as $k)
<div class="modal fade" id="modal-edit-{{ $k->no_bsk }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Data Keluarga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('keluarga.update', $k->no_bsk) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label>No BSK</label>
                            <input type="text" class="form-control" value="{{ $k->no_bsk }}" readonly>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>RT / RW</label>
                            <select name="rt_rw" class="form-select" required>
                                @foreach ([
                                    'RT 01/RW 04',
                                    'RT 02/RW 04',
                                    'RT 03/RW 04',
                                    'RT 03/RW 03',
                                    'RW 05 PB',
                                    'RT/RW Luar'
                                ] as $rt)
                                    <option value="{{ $rt }}"
                                        {{ $k->rt_rw == $rt ? 'selected' : '' }}>
                                        {{ $rt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Aktif" {{ $k->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Nonaktif" {{ $k->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label>Nama Kepala Keluarga</label>
                        <input type="text" name="nama_kk" class="form-control" value="{{ $k->nama_kk }}" required>
                    </div>

                    <div class="mb-2">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required>{{ $k->alamat }}</textarea>
                    </div>
                    
                    <div class="mt-2">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control">{{ $k->keterangan }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn btn-primary">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
