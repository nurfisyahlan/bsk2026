@extends('layouts.app')

@section('title', 'Data Keluarga')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Data Keluarga BSK</h4>
        <span class="text-muted small">
            Total: {{ $keluargas->count() }} Keluarga
        </span>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>No BSK</th>
                        <th>Nama Kepala Keluarga</th>
                        <th>Alamat</th>
                        <th>RT / RW</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($keluargas as $index => $k)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $k->no_bsk }}</td>
                            <td>{{ $k->nama_kk }}</td>
                            <td>{{ $k->alamat }}</td>
                            <td class="text-center">{{ $k->rt_rw }}</td>
                            <td class="text-center">
                                <span class="badge 
                                    {{ $k->status === 'Aktif' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $k->status }}
                                </span>
                            </td>
                            <td>{{ $k->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Data keluarga belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection