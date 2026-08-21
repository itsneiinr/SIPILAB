@extends('layouts.app2')
@section('content')

<style>
.container {
    padding: 25px;
}

.title {
    font-size:28px;
    font-weight:700;
    color:#0B3D4B;
    margin-bottom:20px;
}

.grid {
    display: grid;
    grid-template-columns: repeat(4,1fr);
    gap: 20px;
    margin-top: 20px;
}

.card {
    background: linear-gradient(145deg, #ffffff, #f1f5f9);
    padding: 15px;
    border-radius: 15px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.06);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.stat h1 {
    font-size: 30px;
    margin-top: 5px;
}

.section {
    margin-top: 25px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    text-align: left;
    padding: 12px;
    color: #777;
}

td {
    padding: 12px;
    border-top: 1px solid #eee;
}

tr:hover {
    background: #f9fbff;
}

.badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
}

.wait {
    background: #fff4cc;
    color: #b38f00;
}

ul {
    margin-top: 10px;
    padding-left: 18px;
    color: gray;
}
</style>

<div class="container">
    <div class="title">Selamat Datang, Admin!</div>

    <div class="grid">
        <div class="card stat">
            <h4>Total Mahasiswa</h4>
            <h1>{{ $totalMahasiswa }}</h1>
            <small>Mahasiswa aktif</small>
        </div>

        <div class="card stat">
            <h4>Jadwal Hari Ini</h4>
            <h1>{{ $jadwalHariIni }}</h1>
            <small>Piket berlangsung</small>
        </div>

        <div class="card stat">
            <h4>Progress Piket</h4>
            <h1>{{ $sudahPiketHariIni }}/{{ $jadwalHariIni }}</h1>
            <small>Mahasiswa sudah menyelesaikan piket hari ini</small>
        </div>

        <div class="card stat">
            <h4>Pengajuan Tukar</h4>
            <h1>{{ $pengajuanPending }}</h1>
            <small style="color:orange;">Menunggu</small>
        </div>
    </div>

    <div class="section">
        <div class="card">
            <h4>Jadwal Piket Terdekat</h4>
            <table>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Lab</th>
                </tr>

                @forelse($jadwalTerdekat as $jadwal)
                <tr>
                    <td>
                        {{ $jadwal->mahasiswa->name ?? '-' }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d M Y') }}
                    </td>

                    <td>
                        {{ $jadwal->laboratorium->nama_lab ?? '-' }}
                    </td>
                </tr>
                @empty

                <tr>
                    <td colspan="3" style="text-align:center;">
                        Belum ada jadwal piket
                    </td>
                </tr>

                @endforelse            
            </table>
        </div>
    </div>

    <div class="section">
        <div class="card" style="border-left:5px solid orange;">
            <h4>Perlu Perhatian</h4>
            <p style="color:gray;">
                Ada {{ $pengajuanPending }} pengajuan tukar jadwal yang belum diproses
            </p>
            <span class="badge wait">Segera cek menu Tukar Jadwal</span>
        </div>
    </div>
</div>

@endsection