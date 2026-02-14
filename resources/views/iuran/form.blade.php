{{-- NO BSK & TAHUN --}}
<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">No BSK</label>
        <select name="no_bsk" class="form-control" required>
            <option value="">-- Pilih Keluarga --</option>
            @foreach ($keluarga as $k)
                <option value="{{ $k->no_bsk }}"
                    {{ isset($data) && $data->no_bsk == $k->no_bsk ? 'selected' : '' }}>
                    {{ $k->no_bsk }} - {{ $k->nama_kk }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Tahun</label>
        <select name="tahun" class="form-control" required>
            @foreach (['2024','2025','2026','2027','2028','2029'] as $t)
                <option value="{{ $t }}"
                    {{ isset($data) && $data->tahun == $t ? 'selected' : '' }}>
                    {{ $t }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<hr>

{{-- TANGGAL PEMBAYARAN --}}
<div class="mb-3">
    <label class="form-label">Tanggal Pembayaran</label>
    <input type="date" id="tgl_bayar" class="form-control">
    <small class="text-muted">
        Pilih tanggal lalu centang bulan yang dibayar
    </small>
</div>

{{-- PILIH BULAN --}}
<label class="form-label mb-2">Bulan yang Dibayar</label>

<div class="row mb-3">
@php
$bulan = [
    'januari','februari','maret','april','mei','juni',
    'juli','agustus','september','oktober','november','desember'
];
@endphp

@foreach ($bulan as $b)
    <div class="col-md-4">
        <div class="form-check">
            <input class="form-check-input bulan-check"
                   type="checkbox"
                   value="{{ $b }}"
                   id="chk_{{ $b }}"
                   {{ isset($data) && $data->$b ? 'checked' : '' }}>
            <label class="form-check-label text-capitalize" for="chk_{{ $b }}">
                {{ $b }}
            </label>
        </div>
    </div>
@endforeach
</div>

{{-- INPUT HIDDEN (YANG MASUK KE DB) --}}
@foreach ($bulan as $b)
    <input type="hidden"
           name="{{ $b }}"
           id="input_{{ $b }}"
           value="{{ $data->$b ?? '' }}">
@endforeach

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const tglBayar = document.getElementById('tgl_bayar');

    document.querySelectorAll('.bulan-check').forEach(cb => {
        cb.addEventListener('change', function () {
            const target = document.getElementById('input_' + this.value);

            if (this.checked) {
                if (!tglBayar.value) {
                    alert('Pilih tanggal pembayaran terlebih dahulu');
                    this.checked = false;
                    return;
                }
                target.value = tglBayar.value;
            } else {
                target.value = '';
            }
        });
    });

});
</script>
