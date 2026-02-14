@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h3 class="mb-3">Histori Saldo BSK</h3>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-2">Kembali ke Dashboard</a>
</div>

<div class="mb-3">
    <span class="text-muted">Saldo Terkini :</span>
    <span class="fw-bold fs-5 text-success">
        Rp {{ number_format($saldoTerkini, 0, ',', '.') }}
    </span>
</div>

<button class="btn btn-primary mb-3 justify-content-end" data-bs-toggle="modal" data-bs-target="#modalTambahSaldo">
    + Tambah Transaksi
</button>
    
<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark text-center">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Uraian</th>
            <th class="text-center">Masuk</th>
            <th class="text-center">Keluar</th>
            <th class="text-center">Saldo</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $saldo = 0; @endphp

        @forelse ($saldoList as $i => $s)
            @php
                if ($s->jenis == 'Masuk') {
                    $saldo += $s->jumlah;
                } else {
                    $saldo -= $s->jumlah;
                }
            @endphp
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center">{{ $s->tanggal->format('d-m-Y') }}</td>
                <td>
                    <strong>{{ $s->uraian }}</strong>
                    @if ($s->keterangan)
                        <br>
                        <small class="text-muted">{{ $s->keterangan }}</small>
                    @endif
                </td>
                <td class="text-end text-success text-center">
                    {{ $s->jenis == 'Masuk' ? number_format($s->jumlah,0,',','.') : '-' }}
                </td>
                <td class="text-end text-danger text-center">
                    {{ $s->jenis == 'Keluar' ? number_format($s->jumlah,0,',','.') : '-' }}
                </td>
                <td class="text-end fw-bold text-center">
                    {{ number_format($saldo,0,',','.') }}
                </td>

                {{-- AKSI --}}
                <td class="text-center">
                    <!-- EDIT -->
                    <button class="btn btn-sm btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $s->id }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- DELETE -->
                    <form action="{{ route('saldo.destroy', $s->id) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>

            {{-- MODAL EDIT --}}
            <div class="modal fade" id="editModal{{ $s->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('saldo.update', $s->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title">Edit Transaksi Saldo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control"
                                            value="{{ $s->tanggal->format('Y-m-d') }}" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Jenis</label>
                                        <select name="jenis" class="form-control" required>
                                            <option value="Masuk" {{ $s->jenis=='Masuk'?'selected':'' }}>Masuk</option>
                                            <option value="Keluar" {{ $s->jenis=='Keluar'?'selected':'' }}>Keluar</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Jumlah</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" name="jumlah" class="form-control"
                                                value="{{ $s->jumlah }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Uraian</label>
                                        <input type="text" name="uraian" class="form-control"
                                            value="{{ $s->uraian }}" required>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="2">{{ $s->keterangan }}</textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @empty
            <tr>
                <td colspan="7" class="text-center text-muted">
                    Belum ada data saldo
                </td>
            </tr>
        @endforelse
    </tbody>

</table>
    

<!-- Modal Tambah Saldo -->
<div class="modal fade" id="modalTambahSaldo" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('saldo.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Transaksi Saldo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jenis</label>
                            <select name="jenis" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="Masuk">Masuk</option>
                                <option value="Keluar">Keluar</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Uraian</label>
                            <input type="text" name="uraian" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Keterangan (opsional)</label>
                            <input type="text" name="keterangan" class="form-control">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>        
@endsection
