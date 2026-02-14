@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card-header">
        <h5 class="mb-0">Tambah Data Keluarga</h5>
    </div>    
        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form action="{{ route('keluarga.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">No BSK</label>
            <input type="text" name="no_bsk" class="form-control" value="{{ old('no_bsk') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Kepala Keluarga</label>
            <input type="text" name="nama_kk" class="form-control" value="{{ old('nama_kk') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">RT / RW</label>
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
                    <option value="{{ $rt }}" {{ old('rt_rw') == $rt ? 'selected' : '' }}>
                        {{ $rt }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" required>
                <option value="">-- Pilih Status --</option>
                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>   
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('keluarga.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>        

@endsection 


<!-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Keluarga</title>   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Tambah Data Keluarga</h5>
        </div>

        <div class="card-body">
            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('keluarga.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">No BSK</label>
                    <input type="text" name="no_bsk" class="form-control" value="{{ old('no_bsk') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Kepala Keluarga</label>
                    <input type="text" name="nama_kk" class="form-control" value="{{ old('nama_kk') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">RT / RW</label>
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
                            <option value="{{ $rt }}" {{ old('rt_rw') == $rt ? 'selected' : '' }}>
                                {{ $rt }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>   
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('keluarga.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html> -->
