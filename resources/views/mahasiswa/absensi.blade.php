@extends('layouts.app')
@section('content')

<style>
.title {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 20px;
}

.alert-success{
    background:#d4edda;
    color:#155724;
    padding:12px;
    border-radius:8px;
    margin-bottom:15px;
}

.alert-danger{
    background:#f8d7da;
    color:#721c24;
    padding:12px;
    border-radius:8px;
    margin-bottom:15px;
}

.tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.tab-btn {
    padding: 10px 20px;
    border-radius: 8px;
    background: #eee;
    cursor: pointer;
    border: none;
}

.tab-btn.active {
    background: #0f4c5c;
    color: white;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.card {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.input-group {
    margin-bottom: 15px;
}

.input-group label {
    font-size: 14px;
}

.input-group input,
.input-group select {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ddd;
}

.btn {
    background: #0f4c5c;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 8px;
    width: 100%;
    cursor: pointer;
}

.preview img {
    max-width: 200px;
    display: none;
    margin-top: 10px;
    border-radius: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th {
    background: #f4f7fe;
    padding: 10px;
    text-align: left;
}

table td {
    padding: 10px;
    border-bottom: 1px solid #eee;
}

.foto-riwayat{
    width:70px;
    border-radius:8px;
}
</style>

<div class="title">Absensi Piket</div>

@if(session('success'))
<div class="alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert-danger">
    {{ session('error') }}
</div>
@endif

@if($errors->any())
<div class="alert-danger">
    {{ $errors->first() }}
</div>
@endif

<div class="tabs">
    <button class="tab-btn active" onclick="showTab(event,'form')">
        Upload Absensi
    </button>

    <button class="tab-btn" onclick="showTab(event,'riwayat')">
        Riwayat
    </button>
</div>

<div id="form" class="tab-content active">
    <div class="card">
        <form action="{{ route('absensi.simpan') }}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="input-group">
                <label><b>Nama Lengkap</b></label>
                <input type="text" value="{{ auth()->user()->name }}" readonly>
            </div>

            <div class="input-group">
                <label><b>NIM</b></label>
                <input type="text" value="{{ auth()->user()->nim }}" readonly>
            </div>

            <div class="input-group">
                <label><b>Tanggal Piket</b></label>
                <input type="date" value="{{ date('Y-m-d') }}" readonly>
            </div>

            <div class="input-group">
                <label><b>Jadwal Hari Ini</b></label>
                @if($jadwalHariIni)
                    <input type="text" value="{{ $jadwalHariIni->laboratorium->nama_lab }}" readonly>
                @else
                    <input type="text" value="Tidak ada jadwal piket hari ini" readonly>
                @endif
            </div>

            <div class="input-group">
                <label><b>Upload Foto Bukti</b></label>
                <input type="file" name="bukti_foto" id="foto" accept="image/*">
                
                <div class="preview">
                    <img id="previewImage">
                </div>
            </div>

            @if($jadwalHariIni)

                @if(!$sudahAbsen)
                    <button type="submit" class="btn">
                        Absen Sekarang
                    </button>
                @else
                    <button type="button"
                            class="btn"
                            style="background:#28a745;">
                        Sudah Absen Hari Ini
                    </button>
                @endif

            @else
                <button type="button" class="btn" style="background:#999;">
                    Tidak Ada Jadwal Hari Ini
                </button>
            @endif
        </form>
    </div>
</div>

<div id="riwayat" class="tab-content">
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Foto</th>
                </tr>
            </thead>

            <tbody>
            @forelse($riwayat as $item)
            <tr>
                <td>
                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                </td>

                <td>
                    {{ $item->jam_absen }}
                </td>

                <td>
                    {{ $item->status }}
                </td>

                <td>
                    @if($item->bukti_foto)
                        <img
                            src="{{ asset('uploads/absensi/'.$item->bukti_foto) }}"
                            class="foto-riwayat">
                    @else
                        -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center;">
                    Belum ada riwayat absensi
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</div>

<script>
function showTab(event, tabId)
{
    document.querySelectorAll('.tab-content')
        .forEach(tab => tab.classList.remove('active'));

    document.querySelectorAll('.tab-btn')
        .forEach(btn => btn.classList.remove('active'));

    document.getElementById(tabId)
        .classList.add('active');

    event.currentTarget.classList.add('active');
}

document.getElementById('foto').addEventListener('change', function(e){
    let reader = new FileReader();

    reader.onload = function(){
        let img = document.getElementById('previewImage');
        img.src = reader.result;
        img.style.display = 'block';
    }
    reader.readAsDataURL(e.target.files[0]);
    
});
</script>

@endsection