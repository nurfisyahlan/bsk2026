<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tanggungan</title>
</head>
<body>

<h2>Tambah Tanggungan</h2>

<p>
    <strong>No BSK:</strong> {{ $keluarga->no_bsk }} <br>
    <strong>Kepala Keluarga:</strong> {{ $keluarga->nama_kk }}
</p>

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('tanggungan.store', $keluarga->no_bsk) }}" method="POST">
    @csrf

    <div id="wrapper">
        <div>
            <input type="text" name="nama_tanggungan[]" placeholder="Nama Tanggungan" required>
            <select name="hubungan[]" required>
                <option value="Istri">Istri</option>
                <option value="Anak">Anak</option>
                <option value="Adik">Adik</option>
                <option value="Orang Tua">Orang Tua</option>
                <option value="Lainnya">Lainnya</option>
            </select>
            <select name="status[]" required>
            <option value="Hidup" selected>Hidup</option>
            <option value="Meninggal">Meninggal</option>
        </select>
        </div>
    </div>

    <br>
    <button type="button" onclick="tambah()">+ Tambah Input</button>
    <br>
        <a href="{{ route('tanggungan.create', $keluarga->no_bsk) }}">
            Tambah Tanggungan
        </a>
    <br>

    <button type="submit">Simpan</button>
    <a href="{{ route('keluarga.index') }}">Kembali</a>
</form>

<script>
function tambah() {
    const div = document.createElement('div');
    div.innerHTML = `
        <input type="text" name="nama_tanggungan[]" placeholder="Nama Tanggungan" required>
        <select name="hubungan[]" required>
            <option value="Istri">Istri</option>
            <option value="Anak">Anak</option>
            <option value="Adik">Adik</option>
            <option value="Lainnya">Lainnya</option>
        </select>    
    `;
    document.getElementById('wrapper').appendChild(div);
}
</script>

</body>
</html>
