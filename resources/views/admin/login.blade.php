<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container pt-5">

    <div class="row justify-content-center mt-5 pt-5">

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h4>Login Admin</h4>
                </div>

                <div class="card-body">

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.process') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="text-center">
                            <a href="/">Kembali ke Dashboard</a>
                        </div>
                        
                        <button class="btn btn-primary w-100 mt-3">
                            Login
                        </button>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>