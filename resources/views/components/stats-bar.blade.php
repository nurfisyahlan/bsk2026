<div class="stats-bar mb-3">
    <div class="stat-item">
        <span class="stat-label">Total Keluarga</span>
        <span class="stat-value">{{ $totalKeluarga }}</span>
    </div>

    <div class="stat-item">
        <span class="stat-label">Total Jiwa</span>
        <span class="stat-value">{{ $totalJiwa }}</span>
    </div>

    <div class="stat-item">
        <span class="stat-label">Saldo Kas</span>
        <span class="stat-value">
            Rp {{ number_format($totalSaldo, 0, ',', '.') }}
        </span>
    </div>

    <div class="stat-item">
        <span class="stat-label">Inventaris</span>
        <span class="stat-value">{{ $totalInventaris }}</span>
    </div>
</div>