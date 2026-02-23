@extends('layouts.app')

@section('title', 'Data Kutipan')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Data Kutipan BSK</h4>
        <span class="text-muted small">
            Total: {{ $iuran->count() }} Transaksi
        </span>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>No BSK</th>
                        <th>Nama KK</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($iuran as $index => $k)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $k->no_bsk }}</td>
                            <td>{{ $k->nama_kk }}</td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($k->tanggal)->format('d-m-Y') }}
                            </td>
                            <td class="text-end">
                                Rp {{ number_format($k->jumlah, 0, ',', '.') }}
                            </td>
                            <td>{{ $k->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Data kutipan belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection