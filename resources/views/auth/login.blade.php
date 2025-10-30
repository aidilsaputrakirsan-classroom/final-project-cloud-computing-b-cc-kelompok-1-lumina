<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Lumina App</title>
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(110deg, #7161ef 60%, #8896f8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container-flex {
            background: #fff;
            display: flex;
            max-width: 540px;
            min-height: 400px;
            border-radius: 21px;
            box-shadow: 0 8px 38px rgba(40,40,120,.12);
            width: 100%;
        }
        .form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 36px 32px;
        }
        .login-box {
            width: 100%;
            max-width: 320px;
            margin: 0 auto;
        }
        .login-box h3 { margin: 0 0 16px 0; font-weight: 600; font-size: 21px; text-align: center; }
        .form-group { margin-bottom: 16px; }
        .form-control {
            width: 100%; border: 1.5px solid #dedfff; padding: 13px 14px; border-radius: 10px;
            font-size: 16px; margin-top: 4px; background: #f6f8fc;
        }
        .form-control:focus { outline: 2px solid #8794e5; }
        .btn { display: block; width: 100%; background: #7161ef; color: #fff; padding: 12px;
            border-radius: 10px; border: none; font-weight: 600; font-size: 16px; cursor: pointer; }
        .btn:hover { background: #5b4ad0; }
        .text-small { font-size: 14px; margin-top: 10px; text-align: center; }
        .text-small a { color: #7161ef; text-decoration: underline; }
        .alert-danger {
            background: #ffe4ec; padding: 8px 12px; color: #c21d49; border-radius: 8px;
            font-size: 15px; margin-bottom: 14px; text-align: center;
        }
    </style>
</head>
<body>
<div class="container-flex">
    <div class="form-section">
        <div class="login-box">
            <h3>Haloo Bossku!</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                </div>
                @if ($errors->any())
                    <div class="alert-danger">{{ $errors->first() }}</div>
                @endif
                <button type="submit" class="btn">Login</button>
            </form>
            <div class="text-small">
                Belum punya akun? <a href="{{ route('register') }}">Sign Up</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
