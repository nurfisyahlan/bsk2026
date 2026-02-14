@extends('layouts.app')

@section('title', 'Catat Iuran')

@section('content')
<div class="container">
    <h3>Catat Iuran Bulanan</h3>

    <form action="{{ route('iuran.storeBulanan') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>No BSK</label>
            <select name="no_bsk" class="form-control" required>
                <option value="">-- Pilih Keluarga --</option>
                @foreach ($keluarga as $k)
                    <option value="{{ $k->no_bsk }}">
                        {{ $k->no_bsk }} - {{ $k->nama_kk }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun"
                   class="form-control"
                   value="{{ date('Y') }}" required>
        </div>

        <div class="mb-3">
            <label>Bulan Dibayar</label>
            <div class="row">
                @foreach ([
                    'januari','februari','maret','april','mei','juni',
                    'juli','agustus','september','oktober','november','desember'
                ] as $bulan)
                    <div class="col-md-3">
                        <label>
                            <input type="checkbox" name="bulan[]" value="{{ $bulan }}">
                            {{ ucfirst($bulan) }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <button class="btn btn-success">Simpan Iuran</button>
        <a href="{{ route('iuran.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
