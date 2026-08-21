<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login Mahasiswa - SIPiLAB</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    margin: 0;
}

.container {
    width: 100%;
    height: 100vh;
    display: flex;
}

.left {
    width: 50%;
    background: url('/images/lab2.jpg') no-repeat center;
    background-size: cover;
    position: relative;
}

.left::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(0, 150, 136, 0.5);
}

.right {
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-box {
    width: 100%;
    max-width: 400px;
    padding: 30px;
}

.logo {
    text-align: center;
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 30px;

    background: linear-gradient(90deg, #0089AF, #62EAC2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.input-group {
    margin-bottom: 15px;
}

.input-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
}

.input-group input:focus {
    border-color: #00a8a8;
}

.btn {
    margin-top: 10px;
    padding: 12px;
    width: 100%;
    background: #0B3D4B;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn:hover {
    background: #072a33;
}

.login-link{
    text-align:center;
    margin-top:15px;
    font-size:14px;
}

.login-link span{
    color:#666;
}

.login-link a{
    color:#0B3D4B;
    text-decoration:none;
    font-weight:bold;
}

.login-link a:hover{
    color:#0089AF;
}
</style>
</head>

<body>
<div class="container">
    <div class="left"></div>
    <div class="right">
        <div class="login-box">
            <div class="logo">SIPiLAB</div>
            <form action="{{ route('login.mahasiswa.proses') }}" method="POST">
                @csrf
                
                @if(session()->has('successMessage'))
                <div style="color: #155724; background: #d4edda; padding: 12px; border-radius: 8px; margin-bottom: 15px; font-size: 14px; text-align: center; border: 1px solid #c3e6cb;">
                    {{ session('successMessage') }}
                </div>
                @endif

                @if(session()->has('loginError'))
                    <div style="color: #ff4d4d; background: #ffe6e6; padding: 12px; border-radius: 8px; margin-bottom: 15px; font-size: 14px; text-align: center; border: 1px solid #ffb3b3;">
                        {{ session('loginError') }}
                    </div>
                @endif

                <div class="input-group">
                    <input type="text" name="nim" placeholder="NIM" value="{{ old('nim') }}" required autofocus>
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="btn">Login</button>
                <div class="login-link">
                    <span>Belum mempunyai akun?</span>
                    <a href="{{ route('register.mahasiswa') }}">Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>