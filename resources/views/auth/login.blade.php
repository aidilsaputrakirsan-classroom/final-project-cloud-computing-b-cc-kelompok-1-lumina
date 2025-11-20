<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Jelajah Balikpapan</title>
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
        .form-label {
            display: block;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
            color: #123c51;
            margin-bottom: 4px;
        }
        .form-control {
            width: 100%;
            border: 1.5px solid #dedfff;
            padding: 12px 13px;
            border-radius: 10px;
            font-size: 15px;
            background: #f6f8fc;
            box-sizing: border-box;
            transition: border 0.2s;
        }
        .form-control:focus {
            border: 2px solid #ffe082;
            outline: none;
            background: #fafbfd;
        }
        .form-control.is-invalid {
            border-color: #c21d49;
        }
        .invalid-feedback {
            display: block;
            color: #c21d49;
            font-size: 13px;
            margin-top: 4px;
            text-align: left;
        }
        .alert-danger {
            background: #ffe4ec;
            padding: 10px 13px;
            color: #c21d49;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 16px;
            border-left: 4px solid #c21d49;
        }
        .alert-success {
            background: #e8f5e9;
            padding: 10px 13px;
            color: #2e7d32;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 16px;
            border-left: 4px solid #2e7d32;
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
        .btn-login:active {
            transform: scale(0.98);
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
        .signup-text a:hover {
            color: #ffe082;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-card">
        <h3>Haloo Bossku!</h3>
        
        {{-- Tampilkan alert jika ada error --}}
        @if ($errors->any())
            <div class="alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- Tampilkan alert sukses dari register --}}
        @if (session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
        @endif

        {{-- Form Login --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" 
                       id="email"
                       name="email" 
                       placeholder="Masukkan email Anda" 
                       class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}"
                       required 
                       autofocus>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" 
                       id="password"
                       name="password" 
                       placeholder="Masukkan password Anda" 
                       class="form-control @error('password') is-invalid @enderror" 
                       required>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="signup-text">
            Belum punya akun? <a href="{{ route('register') }}">Sign Up di sini</a>
        </div>
    </div>
</div>
</body>
</html>
