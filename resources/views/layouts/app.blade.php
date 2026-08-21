<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>SIPiLAB</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F0F0F0;
        }

        .topbar {
            width: 100%;
            height: 70px;
            background: #0B3D4B;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .top-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            font-weight: 700;
            font-size: 18px;
            background: linear-gradient(90deg, #0089AF, #62EAC2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .menu-toggle {
            font-size: 20px;
            cursor: pointer;
        }

        .main {
            display: flex;
        }

        .sidebar {
            width: 240px;
            height: calc(100vh - 70px);
            background: #ffffff;
            border-right: 1px solid #eee;
            padding: 20px;
            transition: 0.3s;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #333;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background: #f0f4ff;
        }

        .sidebar a i {
            width: 20px;
            text-align: center;
        }

        .sidebar.collapsed span {
            display: none;
        }

        .content {
            flex: 1;
            padding: 20px;
            transition: 0.3s;
        }

        .logout-btn{
            width:100%;
            display:flex;
            align-items:center;
            gap:12px;
            padding:10px;
            border:none;
            background:none;
            color:red;
            border-radius:8px;
            cursor:pointer;
            font-family:'Poppins',sans-serif;
            font-size:15px;
        }

        .logout-btn:hover{
            background:#f0f4ff;
        }
        </style>
        </head>
        <body>
            <div class="topbar">
        <div>
            <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
        </div>
    </div>
    
    <div class="main">
    <div id="sidebar" class="sidebar">
        <a href="/dashboard">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>

        <a href="/jadwal">
            <i class="fas fa-calendar-alt"></i>
            <span>Jadwal Piket</span>
        </a>

        <a href="/tukar">
            <i class="fas fa-right-left"></i>
            <span>Tukar Jadwal</span>
        </a>

        <a href="/absensi">
            <i class="fas fa-clipboard-check"></i>
            <span>Absensi</span>
        </a>

        <a href="/profil">
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("collapsed");
}
</script>

</body>
</html>