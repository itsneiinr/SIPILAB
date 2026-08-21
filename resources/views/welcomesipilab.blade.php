<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SIPiLAB</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body{
    font-family:'Poppins',sans-serif;
    background:#F5F7FA;
}

.navbar{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    z-index:1000;

    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:18px 60px;

    background:
    linear-gradient(
        135deg,
        #0B3D4B,
        #145f73
    );

    backdrop-filter:blur(10px);

    box-shadow:0 2px 15px rgba(255, 255, 255, 0.05);
}

.logo{
    font-size:24px;
    font-weight:700;
    background:linear-gradient(90deg,#0089AF,#62EAC2);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.menu a{
    text-decoration:none;
    color:white;
    margin:0 15px;
    font-weight:500;
}

.menu a:hover{
    color:#62EAC2;
}

.auth-buttons{
    display:flex;
    align-items:center;
    gap:15px;
}

.btn-login,
.btn-admin{
    text-decoration:none;
    padding:10px 30px;
    border-radius:30px;
    font-size:14px;
}

.btn-login{
    border:1px solid #ffffff;
    color:white;
}

.btn-admin{
    background:#ffffff;
    color:#0B3D4B;
}

.hero{
    min-height:100vh;

    display:flex;
    align-items:center;
    justify-content:center;

    text-align:center;

    background:
    linear-gradient(
            rgba(0,0,0,0.55),
            rgba(0,0,0,0.55)
        ),    
    url('{{ asset("images/lab2.jpg") }}');

    background-size:cover;
    background-position:center;

    color:white;

    padding:120px 20px 60px;
}

.hero-content{
    max-width:900px;
}

.hero h1{
    font-size:58px;
    font-weight:700;
    margin-bottom:20px;
    line-height:1.2;
}

.hero-highlight{
    color:#62EAC2;
}

.hero p{
    font-size:18px;
    line-height:1.8;
    max-width:700px;
    margin:auto;
}

.btn-main{
    display:inline-block;
    margin-top:30px;
    padding:14px 35px;
    border-radius:40px;
    background:white;
    color:#0B3D4B;
    text-decoration:none;
    font-weight:600;
    transition:.3s;
}

.btn-main:hover{
    transform:translateY(-3px);
}

.hero-stats{
    display:flex;
    justify-content:center;
    gap:25px;
    flex-wrap:wrap;

    margin-top:50px;
}

.hero-stat{
    background:rgba(255,255,255,0.15);
    border:1px solid rgba(255,255,255,0.2);
    padding:20px;
    border-radius:18px;
    min-width:180px;
}

.hero-stat h2{
    font-size:28px;
}

.hero-stat p{
    font-size:13px;
}

.section{
    min-height:100vh;
    padding:120px 60px 80px;
    display:flex;
    flex-direction:column;
    justify-content:center;}

.section-title{
    text-align:center;
    margin-bottom:40px;
}

.section-title h2{
    font-size:36px;
    color:#0B3D4B;
}

.section-title p{
    color:gray;
}

.btn-cta{
    display:inline-block;
    padding:14px 35px;
    border-radius:40px;
    background:#0B3D4B;
    color:white;
    text-decoration:none;
    font-weight:600;
    transition:.3s;
}

.btn-cta:hover{
    background:#145f73;
}

.grid{
    display:flex;
    justify-content:center;
    gap:25px;
    flex-wrap:wrap;
}

.box{
    width:260px;
    background:white;
    padding:30px 25px;
    text-align:center;
    border-radius:18px;
    border-top:4px solid #0089AF;
    box-shadow:0 10px 30px rgba(0,0,0,0.05);
    transition:.3s;
}

.box:hover{
    transform:translateY(-8px);
}

.box i{
    color:#0089AF;
    margin-bottom:15px;
}

.box h3{
    margin-bottom:10px;
}

.tentang-wrapper{
    display:flex;
    align-items:center;
    gap:50px;
}

.tentang-content{
    flex:1;
}

.tentang-content h1{
    font-size:40px;
    margin-bottom:20px;
}

.tentang-content span{
    color:#0089AF;
}

.tentang-content p{
    color:#555;
    line-height:1.8;
    margin-bottom:15px;
}

.tentang-image{
    flex:1;
    display:flex;
    justify-content:center;
}

.tentang-image img{
    width:100%;
    border-radius:20px;
    object-fit:cover;
    border-radius:20px;
    box-shadow:0 20px 40px rgba(0,0,0,0.1);
}

.cta{
    min-height:100vh;
    padding:0 20px;
    text-align:center;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;}

.cta h2{
    font-size:42px;
    color:#0B3D4B;
    margin-bottom:20px;
}

.cta p{
    font-size:18px;
    color:#666;
    max-width:650px;
    margin-bottom:35px;}

.footer{
    background:linear-gradient(
        135deg,
        #0B3D4B,
        #145f73
    );
    color:white;
    padding:60px 60px 20px;
}

.footer-container{
    display:flex;
    justify-content:space-between;
    gap:40px;
    flex-wrap:wrap;
}

.footer-box{
    max-width:300px;
}

.footer-box h3,
.footer-box h4{
    margin-bottom:15px;
}

.footer-box p{
    color:#ddd;
    margin-bottom:8px;
    font-size:14px;
}

.footer-box a{
    color:#ddd;
    text-decoration:none;
}

.footer-box a:hover{
    color:#62EAC2;
}

.footer-brand{
    display:flex;
    align-items:flex-start;
    gap:20px;
}

.footer-brand img{
    width:70px;
    height:70px;
    object-fit:contain;
}

.footer-brand h3{
    margin-buttom:8px;
    font-size:24px;
}

.footer-brand p{
    color:#ddd;
    font-size:14px;
    line-height:1.6;
    margin:0;
    max-width:250px;
}

.social-icons{
    margin-top:15px;
}

.social-icons a{
    display:inline-block;
    margin-right:10px;
    width:40px;
    height:40px;
    line-height:40px;
    text-align:center;
    border-radius:50%;
    background:rgba(255,255,255,0.15);
    color:white;
}

.social-icons a:hover{
    background:#62EAC2;
    color:#0B3D4B;
}

.footer-bottom{
    text-align:center;
    margin-top:40px;
    padding-top:15px;
    border-top:1px solid rgba(255,255,255,0.2);
}

@media(max-width:900px){

    .navbar{
        padding:15px 20px;
    }

    .menu{
        display:none;
    }

    .hero h1{
        font-size:40px;
    }

    .tentang-wrapper{
        flex-direction:column;
    }

    .section{
        padding:70px 25px;
    }
}
</style>
</head>

<body>
<div class="navbar">
<div class="logo">SIPiLAB</div>

<div class="menu">
    <a href="#">Beranda</a>
    <a href="#fitur">Fitur</a>
    <a href="#tentang">Tentang</a>
    <a href="#cta">Mulai</a>
</div>

<div class="auth-buttons">
    <a href="{{ route('login.mahasiswa') }}" class="btn-login">
        Mahasiswa
    </a>

    <a href="{{ route('login.admin') }}" class="btn-admin">
        Admin
    </a>
</div>

</div>

<div class="hero">
<div class="hero-content">

    <h1>
        Sistem Manajemen
        <span class="hero-highlight">
            Jadwal Piket Lab Komputer
        </span>
    </h1>

    <p>
        Platform digital untuk mengelola jadwal piket laboratorium
        komputer dengan lebih mudah, cepat, dan efisien.
    </p>

    <a href="{{ route('login.mahasiswa') }}"
       class="btn-main">
        Mulai Sekarang
    </a>

</div>
</div>

<div id="fitur" class="section">
<div class="section-title">
    <h2>Fitur SIPiLAB</h2>
    <p>Fitur utama yang membantu mahasiswa mengelola jadwal piket.</p>
</div>

<div class="grid">

    <div class="box">
        <i class="fas fa-calendar-check fa-2x"></i>
        <h3>Jadwal Piket</h3>
        <p>Lihat jadwal piket laboratorium secara realtime.</p>
    </div>

    <div class="box">
        <i class="fas fa-right-left fa-2x"></i>
        <h3>Tukar Jadwal</h3>
        <p>Ajukan pertukaran jadwal dengan mudah.</p>
    </div>

    <div class="box">
        <i class="fas fa-camera fa-2x"></i>
        <h3>Absensi</h3>
        <p>Upload bukti kehadiran langsung dari sistem.</p>
    </div>

</div>
</div>

<div id="tentang" class="section">
<div class="tentang-wrapper">

    <div class="tentang-content">

        <h1>
            Tentang
            <span>SIPiLAB</span>
        </h1>

        <p>
            SIPiLAB merupakan sistem berbasis web yang membantu
            pengelolaan jadwal piket laboratorium komputer secara
            lebih terstruktur dan efisien.
        </p>

        <p>
            Dengan SIPiLAB, mahasiswa dapat melihat jadwal, 
            melakukan absensi, serta mengajukan tukar jadwal 
            secara online sehingga proses menjadi lebih praktis.
        </p>

    </div>

    <div class="tentang-image">
        <img src="{{ asset('images/lab2.jpg') }}">
    </div>

</div>
</div>

<section id="cta" class="cta">
    <h2>Siap Menggunakan SIPiLAB?</h2>

    <p>
        Kelola jadwal piket laboratorium dengan lebih mudah,
        cepat, dan efisien.
    </p>

    <a href="{{ route('login.mahasiswa') }}"
       class="btn-cta">
       Login Mahasiswa
    </a>
</section>

<div class="footer">
<div class="footer-container">
    <div class="footer-box">
    <div class="footer-brand">
        <img src="{{ asset('images/logo.png') }}" alt="Logo SIPiLAB">
        <div>
            <h3>SIPiLAB</h3>
            <p>
                Sistem manajemen jadwal piket laboratorium komputer
                dengan lebih mudah, cepat, dan efisien.
            </p>
        </div>
    </div>

    <div class="social-icons">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-whatsapp"></i></a>
        <a href="#"><i class="fab fa-facebook"></i></a>
    </div>
</div>

    <div class="footer-box">
        <h4>Menu</h4>
        <p><a href="#">Beranda</a></p>
        <p><a href="#fitur">Fitur</a></p>
        <p><a href="#tentang">Tentang</a></p>
    </div>

    <div class="footer-box">
        <h4>Kontak</h4>
        <p><i class="fas fa-envelope"></i> sipilab@kampus.ac.id</p>
        <p><i class="fas fa-phone"></i> 0812-3456-7890</p>
        <p><i class="fas fa-map-marker-alt"></i> Politeknik Negeri Cilacap</p>
    </div>
</div>

<div class="footer-bottom">
    © 2026 SIPiLAB | Sistem Informasi Jadwal Piket Laboratorium Komputer
</div>

</div>
</body>
</html>