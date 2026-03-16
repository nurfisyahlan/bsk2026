<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand">Dashboard Admin BSK</span>

    <a href="{{ route('admin.logout') }}" class="btn btn-danger">
        Logout
    </a>
</nav>

<div class="container mt-4">

    <h3 class="mb-4">Menu Admin</h3>

    <div class="row">

        <div class="col-md-3 mb-3">
            <a href="{{ route('keluarga.index') }}" class="btn btn-primary w-100">
                Data Keluarga
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('iuran.index') }}" class="btn btn-success w-100">
                Data Kutipan
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('saldo.index') }}" class="btn btn-warning w-100">
                Data Saldo
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('inventaris.index') }}" class="btn btn-info w-100">
                Data Inventaris
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary w-100">
                Pengumuman
            </a>
        </div>

    </div>

</div>

</body>
</html>