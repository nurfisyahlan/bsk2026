@extends('layouts.app')

@section('title', 'Data Inventaris')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h3 class="mb-3">Data Inventaris BSK</h3>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-4">Kembali ke Dashboard</a>
</div>

<div class="d-flex justify-content-between align-items-center">    
    <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#createModal">
        + Tambah Inventaris
    </button>
</div>
<!-- BUTTON TAMBAH -->

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama Item</th>
            <th class="text-center">Jenis</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Status</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($inventaris as $item)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $item->nama_item }}</td>
            <td>{{ $item->jenis }}</td>
            <td class="text-center">{{ $item->jumlah }} pcs</td>
            <td class="text-center">
                <span class="badge 
                    {{ $item->status == 'Bagus' ? 'bg-success' : 
                    ($item->status == 'Rusak' ? 'bg-danger' : 'bg-dark') }}">
                    {{ $item->status }}
                </span>
            </td >
            <td class="text-center">{{ $item->tanggal_diperoleh }}</td>
            <td class="text-center">
                <!-- BUTTON EDIT -->
                <button class="btn btn-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#editModal{{ $item->id }}">
                    <i class="bi bi-pencil-square"></i>
                </button>

                <form action="{{ route('inventaris.destroy', $item->id) }}"
                    method="POST"
                    style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus data?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </td>
        </tr>

        <!-- MODAL EDIT -->
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('inventaris.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Inventaris</h5>
                            <button type="button" class="btn-close"
                                data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            @include('inventaris.form', ['item' => $item])
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary">Update</button>
                            <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @empty
        <tr>
            <td colspan="7" class="text-center">Belum ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- ===================== -->
<!-- MODAL CREATE -->
<!-- ===================== -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('inventaris.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Inventaris</h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    @include('inventaris.form', ['item' => null])
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Simpan</button>
                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ======================= --}}
{{-- SWEET ALERT SUCCESS --}}
{{-- ======================= --}}
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: "{{ session('success') }}",
        confirmButtonColor: '#3085d6'
    });
</script>
@endif

@endsection
