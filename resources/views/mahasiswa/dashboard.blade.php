@extends('layouts.app')
@section('content')
@php
\Carbon\Carbon::setLocale('id');
@endphp

<style>
.welcome-box {
    background: #0f4c5c;
    color: white;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 20px;
}

.welcome-box small {
    background: rgba(255,255,255,0.2);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
}

.cards {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.card-box {
    flex: 1;
    background: #f8f8f8;
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 5px 10px rgba(0,0,0,0.08);
}

.card-box h4 {
    font-size: 14px;
    color: #555;
}

.card-box h2 {
    margin-top: 10px;
    font-size: 24px;
}

.card-box span {
    font-size: 13px;
    color: gray;
}

.jadwal-container {
    background: #f8f8f8;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.08);
}

.jadwal-item {
    margin-top: 15px;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.jadwal-left {
    display: flex;
    align-items: center;
    gap: 15px;
}

.icon {
    font-size: 24px;
}

.jadwal-text b {
    display: block;
    font-size: 16px;
}

.jadwal-text small {
    color: gray;
}
</style>

<div class="welcome-box">
    <h2>Selamat Datang, {{ $user->name }}!</h2>
    <br>
    <small>{{ $user->prodi }} • Semester {{ $user->semester }}</small>
</div>

<div class="cards">
    <div class="card-box">
        <h4>Jadwal Piket Saya</h4>
        <h2>{{ $jumlahJadwal }}</h2>
        <span>Bulan ini</span>
    </div>

    <div class="card-box">
        <h4>Tukar Jadwal</h4>
        <h2>{{ $jumlahTukarPending }}</h2>
        <span>Menunggu Persetujuan</span>
    </div>

    <div class="card-box">
        <h4>Absensi</h4>
        <h2>{{ $jumlahAbsensi }}/{{ $jumlahJadwal }}</h2>
        <span>Selesai</span>
    </div>
</div>

<div class="jadwal-container">
    <h3>Jadwal Piket Hari Ini</h3>

    @if($jadwalHariIni)

    <div class="jadwal-item">
        <div class="jadwal-left">
            <div class="icon">📅</div>
            <div class="jadwal-text">
                <b>
                    {{ \Carbon\Carbon::parse($jadwalHariIni->tanggal)->translatedFormat('l') }}
                </b>

                <small>
                    {{ \Carbon\Carbon::parse($jadwalHariIni->tanggal)->format('d M Y') }}
                </small>
            </div>
        </div>

        <div class="jadwal-left">
            <div class="icon">💻</div>
            <div class="jadwal-text">
                <b>
                    {{ $jadwalHariIni->laboratorium->nama_lab }}
                </b>

                <small>
                    {{ date('H:i', strtotime($jadwalHariIni->jam_mulai)) }}
                    -
                    {{ date('H:i', strtotime($jadwalHariIni->jam_selesai)) }}
                    WIB
                </small>
            </div>
        </div>
    </div>

    @else

    <div class="jadwal-item">
        <div class="jadwal-text">
            Tidak ada jadwal piket hari ini
        </div>
    </div>

    @endif
    <div>
    
@endsection