<!DOCTYPE html>
<html>
<head>
    <title>Akun Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f7f8fa; }
        .card { margin-top: 40px; border-radius: 10px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .card-body { padding: 2rem; }
        .user-title { color: #174285; font-weight: bold; margin-bottom: 1rem;}
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="user-title">Akun Saya</div>
                        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><a href="/logout" class="btn btn-sm btn-danger">Logout</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
