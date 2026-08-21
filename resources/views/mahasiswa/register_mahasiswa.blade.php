<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Registrasi Mahasiswa - SIPiLAB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            margin:0;
        }

        .container{
            width:100%;
            min-height:100vh;
            display:flex;
        }

        .left{
            width:50%;
            background:url('/images/lab2.jpg') no-repeat center;
            background-size:cover;
            position:relative;
        }

        .left::after{
            content:'';
            position:absolute;
            width:100%;
            height:100%;
            background: rgba(0, 150, 136, 0.5);
        }

        .right{
            width:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#fff;
            padding:30px;
        }

        .register-box{
            width:100%;
            max-width:450px;
        }

        .logo{
            text-align:center;
            font-size:32px;
            font-weight:bold;
            margin-bottom:10px;
            background:linear-gradient(
                90deg,
                #0089AF,
                #62EAC2
            );

            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        .subtitle{
            text-align:center;
            color:#777;
            margin-bottom:25px;
            font-size:14px;
        }

        .error-list{
            color:#c0392b;
            background:#ffeaea;
            border:1px solid #ffcccc;
            padding:12px;
            border-radius:8px;
            margin-bottom:15px;
            font-size:14px;
        }

        .error-list ul{
            margin-left:18px;
        }

        .input-group{
            margin-bottom:14px;
        }

        .input-group input{
            width:100%;
            padding:12px;
            border:1px solid #ddd;
            border-radius:8px;
            outline:none;
        }

        .input-group select{
            width:100%;
            padding:12px;
            border:1px solid #ddd;
            border-radius:8px;
            outline:none;
            background:white;
            font-size:14px;
            color:#333;
        }

        .input-group select:focus{
            border-color:#0089AF;
        }

        .input-group input:focus{
            border-color:#0089AF;
        }

        .btn{
            margin-top:10px;
            padding:12px;
            width:100%;
            background:#0B3D4B;
            color:white;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-size:15px;
            font-weight:600;
        }

        .btn:hover{
            background:#072a33;
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

        @media(max-width:900px){

            .left{
                display:none;
            }

            .right{
                width:100%;
            }

        }
        </style>
        </head>
        
        <body>
            <div class="container">
            <div class="left"></div>
            <div class="right">
                <div class="register-box">
                    <div class="logo">SIPiLAB</div>
                    <div class="subtitle">
                        Registrasi Akun Mahasiswa
                    </div>

                    @if ($errors->any())
                        <div class="error-list">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.mahasiswa.proses') }}" method="POST">
                        @csrf

                        <div class="input-group">
                            <input type="text" name="name" placeholder="Nama Lengkap" required value="{{ old('name') }}">
                        </div>

                        <div class="input-group">
                            <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                        </div>

                        <div class="input-group">
                            <input type="text" name="nim" placeholder="NIM" required value="{{ old('nim') }}">
                        </div>

                        <div class="input-group">
                            <select name="prodi" required>
                                <option value="" disabled selected hidden>
                                    Program Studi
                                </option>

                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Teknologi Rekayasa Multimedia">Teknologi Rekayasa Multimedia</option>
                                <option value="Rekayasa Keamanan Siber">Rekayasa Keamanan Siber</option>
                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                <option value="Akuntansi Lembaga Keuangan Syariah">
                                    Akuntansi Lembaga Keuangan Syariah
                                </option>
                            </select>
                        </div>            
                        
                        <div class="input-group">
                            <select name="semester" required>
                                <option value="" disabled {{ old('semester') ? '' : 'selected' }}>
                                    Semester
                                </option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('semester') == $i ? 'selected' : '' }}>
                                        Semester {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" placeholder="Password (Minimal 8 Karakter)" required>
                        </div>

                        <button type="submit" class="btn">
                            Daftar Akun
                        </button>

                        <div class="login-link">
                            <span>Sudah mempunyai akun?</span>
                            <a href="{{ route('login.mahasiswa') }}">
                                Login di sini
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>