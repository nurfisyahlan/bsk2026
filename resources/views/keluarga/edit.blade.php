@extends('layouts.app')

@section('title', 'Data Keluarga BSK')

@section('content')
    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('keluarga.update', $keluarga->no_bsk) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>No BSK</label><br>
            <input type="text" value="{{ $keluarga->no_bsk }}" readonly>
        </p>

        <p>
            <label>Nama Kepala Keluarga</label><br>
            <input type="text" name="nama_kk"
                value="{{ old('nama_kk', $keluarga->nama_kk) }}" required>
        </p>

        <p>
            <label>Alamat</label><br>
            <textarea name="alamat" required>{{ old('alamat', $keluarga->alamat) }}</textarea>
        </p>

        <p>
            <label>RT / RW</label><br>
            <select name="rt_rw" required>
                @foreach ([
                    'RT 01/RW 04',
                    'RT 02/RW 04',
                    'RT 03/RW 04',
                    'RT 03/RW 03',
                    'RW 05 PB',
                    'RT/RW Luar'
                ] as $rt)
                    <option value="{{ $rt }}"
                        {{ old('rt_rw', $keluarga->rt_rw) == $rt ? 'selected' : '' }}>
                        {{ $rt }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Status</label><br>
            <select name="status" required>
                <option value="Aktif"
                    {{ old('status', $keluarga->status) == 'Aktif' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="Nonaktif"
                    {{ old('status', $keluarga->status) == 'Nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>
        </p>    

        <p>
            <label>Keterangan</label><br>
            <textarea name="keterangan">{{ old('keterangan', $keluarga->keterangan) }}</textarea>
        </p>

        <button type="submit">Update</button>
        <a href="{{ route('keluarga.index') }}">Kembali</a>
    </form>

@endsection

