@extends('layouts.app')

@section('title', 'Data Iuran')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h3>Data Kutipan Tahun {{ $tahunDipilih }}</h3>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-2">Kembali ke Dashboard</a>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">    
        <form method="GET" >
            
                {{-- tombol tahun sebelumnya --}}
                <a href="{{ route('iuran.index', ['tahun' => $tahunDipilih - 1]) }}"
                    class="btn btn-outline-secondary btn-sm">
                    ← Tahun Sebelumnya
                </a>
                

                {{-- tombol tahun setelahnya --}}
                <a href="{{ route('iuran.index', ['tahun' => $tahunDipilih + 1]) }}"
                    class="btn btn-outline-secondary btn-sm">
                    Tahun Setelahnya →
                </a>

        </form>   
        
        {{-- FILTER STATUS --}}
        <form method="GET">
            <input type="hidden" name="tahun" value="{{ $tahunDipilih }}">
            <input type="hidden" name="rt_rw" value="{{ request('rt_rw') }}">

            <div class="btn-group">
                <button name="status" value=""
                    class="btn btn-sm {{ request('status') == null ? 'btn-dark' : 'btn-outline-dark' }}">
                    Semua
                </button>
                <button name="status" value="sudah_lunas"
                    class="btn btn-sm {{ request('status') == 'sudah_lunas' ? 'btn-success' : 'btn-outline-success' }}">
                    Sudah Lunas
                </button>
                <button name="status" value="belum_lunas"
                    class="btn btn-sm {{ request('status') == 'belum_lunas' ? 'btn-warning' : 'btn-outline-warning' }}">
                    Belum Lunas
                </button>
            </div>
        </form>

        {{-- FILTER RT/RW --}}
        <form method="GET"> 
            <input type="hidden" name="tahun" value="{{ $tahunDipilih }}">
            <input type="hidden" name="status" value="{{ request('status') }}">

            <select name="rt_rw"
                class="form-select form-select-sm"
                onchange="this.form.submit()">
                <option value="">Semua RT/RW</option>
                @foreach ($listRtRw as $rt)
                    <option value="{{ $rt }}"
                        {{ request('rt_rw') == $rt ? 'selected' : '' }}>
                        {{ $rt }}
                    </option>
                @endforeach
            </select>
        </form>
    

        <button class="btn btn-success"
            data-bs-toggle="modal"
            data-bs-target="#createIuranModal">
            + Tambah Iuran
        </button>
    </div>

    {{-- ================= TABLE DATA ================= --}}
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th class="text-center">No</th>
                <th>No BSK</th>
                <th>Nama KK</th>            
                <th class="text-center">RT/RW</th>            
                <th class="text-center">Tahun</th>            
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse ($iuran as $row)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $row->no_bsk }}</td>
                <td>{{ $row->keluarga->nama_kk ?? '-' }}</td>                       
                <td class="text-center">{{ $row->keluarga->rt_rw }}</td>                       
                <td class="text-center">{{ $row->tahun }}</td>                       
                <td class="text-center">
                    <span class="badge {{ $row->status === 'sudah_lunas' ? 'bg-success' : 'bg-warning' }}">
                        {{ ucfirst(str_replace('_',' ',$row->status)) }}
                    </span>
                </td>
                <td class="d-flex gap-1 text-center justify-content-center">
                    <button class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#editIuranModal{{ $row->id }}">
                        <i class="bi bi-info-circle"></i>
                    </button>

                    <button class="btn btn-info btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#detailIuranModal{{ $row->id }}">
                        <i class="bi bi-stickies"></i>
                    </button>

                    <form action="{{ route('iuran.destroy', $row->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus seluruh iuran tahun ini?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted">
                    Tidak ada data
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- ================= MODAL EDIT & DETAIL (DI LUAR TABLE) ================= --}}
    @foreach ($iuran as $row)

        {{-- ========== MODAL EDIT ========== --}}
        <div class="modal fade" id="editIuranModal{{ $row->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">

                    <form action="{{ route('iuran.storeBulanan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="no_bsk" value="{{ $row->no_bsk }}">
                        <input type="hidden" name="tahun" value="{{ $row->tahun }}">

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Iuran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                           <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>No BSK:</strong> {{ $row->no_bsk }} <br>
                                    <strong>Nama KK:</strong> {{ $row->keluarga->nama_kk ?? '-' }} <br>
                                    <strong>Tahun:</strong> {{ $row->tahun }} 
                                </div>
                                
                                <div class="col-md-6">
                                    <strong>Status:</strong>
                                    <span class="badge {{ $row->status === 'sudah_lunas' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst(str_replace('_',' ',$row->status)) }}
                                    </span> <br>
                                    <strong>Nominal:</strong> <br>
                                    <strong><a href="{{ route('keluarga.detail', $row->no_bsk) }}">Lihat Detail keluarga</a></strong>  <br>
                                </div>
                            </div>

                            <hr>

                            @php
                                $bulanDetail = $row->detail
                                    ->pluck('tanggal_bayar','bulan')
                                    ->map(fn ($tgl) => \Carbon\Carbon::parse($tgl)->format('d-m-Y'))
                                    ->toArray();
                            @endphp

                            <div class="form-check mb-3">
                                <input type="checkbox"
                                    class="form-check-input check-all-bulan"
                                    id="checkAll{{ $row->id }}"
                                    data-target="{{ $row->id }}">
                                <label class="form-check-label" for="checkAll{{ $row->id }}">
                                    1 Tahun
                                </label>
                            </div>                        

                            <div class="row">
                                @foreach ([
                                    'januari','februari','maret','april','mei','juni',
                                    'juli','agustus','september','oktober','november','desember'
                                ] as $bulan)
                                    <div class="col-md-3 mb-2">
                                        <label class="form-check-label">
                                            <input type="checkbox"
                                            name="bulan[]"
                                            value="{{ $bulan }}"
                                            class="form-check-input checkbox-bulan"
                                            data-parent="{{ $row->id }}"
                                            {{ array_key_exists($bulan, $bulanDetail) ? 'checked disabled' : '' }}>
                                            {{ ucfirst($bulan) }}
                                        </label>

                                        @if (array_key_exists($bulan, $bulanDetail))                                            
                                            <input type="date"
                                                name="tanggal_edit[{{ $bulan }}]"
                                                value="{{ \Carbon\Carbon::createFromFormat('d-m-Y', $bulanDetail[$bulan])->format('Y-m-d') }}"
                                                class="form-control form-control-sm text-success">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button class="btn btn-success">
                                Simpan Pembayaran
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- ========== MODAL DETAIL ========== --}}
        <div class="modal fade" id="detailIuranModal{{ $row->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" style="font-weight: bold;">
                            {{ $row->no_bsk }} - {{ $row->keluarga->nama_kk ?? '-' }} - 
                            tahun {{ $row->tahun }}
                        </h5>                      
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bulan</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($row->detail as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucfirst($d->bulan) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($d->tanggal_bayar)->format('d-m-Y') }}</td>
                                        <td>Rp {{ number_format($d->nominal,0,',','.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">
                                            Belum ada pembayaran
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>

                </div>
            </div>
        </div>

    @endforeach

    {{-- ================= MODAL CREATE ================= --}}
    <div class="modal fade" id="createIuranModal">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('iuran.storeBulanan') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Tambah Iuran</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row mb-2 align-items-end">
                            <div class="col-md-8">
                                <label>Keluarga</label>
                                <select name="no_bsk" class="form-control" required>
                                    @foreach ($keluarga as $k)
                                        <option value="{{ $k->no_bsk }}">
                                            {{ $k->no_bsk }} - {{ $k->nama_kk }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Tahun</label>
                                <input type="number"
                                    name="tahun"
                                    value="{{ date('Y') }}"
                                    class="form-control"
                                    required>
                            </div>
                        </div>


                        <hr>                

                        <div class="form-check mb-3">
                            <input type="checkbox"
                                class="form-check-input check-all-create"
                                id="checkAllCreate">
                            <label class="form-check-label" for="checkAllCreate">
                                1 Tahun
                            </label>
                        </div>

                        <div class="row justify-content-center g-1">
                            @foreach ([
                                'januari','februari','maret','april','mei','juni',
                                'juli','agustus','september','oktober','november','desember'
                            ] as $bulan)
                                <div class="col-md-3">
                                    <label>
                                        <input type="checkbox"
                                            name="bulan[]"
                                            value="{{ $bulan }}"
                                            class="form-check-input checkbox-bulan-create">
                                        {{ ucfirst($bulan) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.check-all-bulan').forEach(function (checkAll) {
        checkAll.addEventListener('change', function () {

            let targetId = this.dataset.target;
            let isChecked = this.checked;

            document.querySelectorAll(
                '.checkbox-bulan[data-parent="' + targetId + '"]'
            ).forEach(function (checkbox) {

                // hanya bulan yang BELUM dibayar
                if (!checkbox.disabled) {
                    checkbox.checked = isChecked;
                }

            });
        });
    });

});

document.addEventListener('DOMContentLoaded', function () {

    // ================= CREATE: CENTANG 1 TAHUN =================
    const checkAllCreate = document.getElementById('checkAllCreate');

    if (checkAllCreate) {
        checkAllCreate.addEventListener('change', function () {
            document.querySelectorAll('.checkbox-bulan-create').forEach(cb => {
                cb.checked = this.checked;
            });
        });
    }

});
</script>

@endsection
