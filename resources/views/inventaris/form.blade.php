<div class="mb-3">
    <label>Nama Item</label>
    <input type="text" name="nama_item"
        value="{{ old('nama_item', $item->nama_item ?? '') }}"
        class="form-control" required>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label>Jenis</label>
        <select name="jenis" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="Peralatan Utama"
                {{ old('jenis', $item->jenis ?? '') == 'Peralatan Utama' ? 'selected' : '' }}>
                Peralatan Utama
            </option>

            <option value="Peralatan Pendukung"
                {{ old('jenis', $item->jenis ?? '') == 'Peralatan Pendukung' ? 'selected' : '' }}>
                Peralatan Pendukung
            </option>

        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label>Jumlah (pcs/set)</label>
        <input type="number" name="jumlah"
            value="{{ old('jumlah', $item->jumlah ?? '') }}"
            class="form-control" min="1" required>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="Bagus"
                {{ old('status', $item->status ?? '') == 'Bagus' ? 'selected' : '' }}>
                Bagus
            </option>

            <option value="Rusak"
                {{ old('status', $item->status ?? '') == 'Rusak' ? 'selected' : '' }}>
                Rusak
            </option>

            <option value="Hilang"
                {{ old('status', $item->status ?? '') == 'Hilang' ? 'selected' : '' }}>
                Hilang
            </option>

        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label>Tanggal Diperoleh</label>
        <input type="date" name="tanggal_diperoleh"
            value="{{ old('tanggal_diperoleh', $item->tanggal_diperoleh ?? '') }}"
            class="form-control" required>
    </div>
</div>
<div class="mb-3">
    <label>Keterangan</label>
    <textarea name="keterangan" class="form-control">
        {{ old('keterangan', $item->keterangan ?? '') }}
    </textarea>
</div>
