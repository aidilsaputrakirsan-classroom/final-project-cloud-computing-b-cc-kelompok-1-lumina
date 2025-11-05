<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Inter', Arial, Helvetica, sans-serif;
            background: #123c51;
        }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        .login-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 38px rgba(18,60,81,.08);
            max-width: 370px;
            width: 100%;
            padding: 36px 30px 28px 30px;
            margin: 0 auto;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .login-card h3 {
            margin-bottom: 22px;
            font-size: 24px;
            font-weight: 800;
            color: #123c51;
        }
        .form-group {
            margin-bottom: 16px;
            width: 100%;
        }
        .form-control {
            width: 100%;
            border: 1.5px solid #dedfff;
            padding: 12px 13px;
            border-radius: 10px;
            font-size: 15px;
            margin-top: 4px;
            background: #f6f8fc;
            box-sizing: border-box;
            transition: border 0.2s;
        }
        .form-control:focus {
            border: 2px solid #ffe082;
            outline: none;
        }
        .btn-login {
            width: 100%;
            border-radius: 10px;
            background: #123c51;
            color: #ffe082;
            font-weight: 700;
            font-size: 16px;
            padding: 12px 0;
            border: none;
            cursor: pointer;
            margin-top: 8px;
            box-shadow: 0 3px 12px rgba(18,60,81,0.07);
            transition: background 0.2s, color 0.2s;
        }
        .btn-login:hover {
            background: #ffe082;
            color: #123c51;
            border: 2px solid #123c51;
        }
        .alert-danger {
            background: #ffe4ec;
            padding: 9px 13px;
            color: #c21d49;
            border-radius: 8px;
            font-size: 15px;
            margin-bottom: 13px;
        }
        .signup-text {
            margin-top: 16px;
            font-size: 15px;
        }
        .signup-text a {
            color: #123c51;
            text-decoration: underline;
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-card">
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
            <button type="submit" class="btn-login">Login</button>
        </form>
        <div class="signup-text">
            Belum punya akun? <a href="{{ route('register') }}">Sign Up</a>
        </div>
    </div>
</div>
</body>
</html>
