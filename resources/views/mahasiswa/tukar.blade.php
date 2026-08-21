@extends('layouts.app')
@section('content')

<style>
.title {
    font-size: 24px;
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
    gap: 15px;
    margin-bottom: 20px;
}

.tab-btn {
    padding: 8px 18px;
    border-radius: 8px;
    background: #eee;
    border: none;
    cursor: pointer;
    font-weight: 500;
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
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    width: 100%;
}

.input-group {
    margin-bottom: 15px;
}

.input-group label {
    font-size: 14px;
    display: block;
    margin-bottom: 5px;
}

.input-group select,
.input-group textarea {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ddd;
}

.btn {
    margin-top: 10px;
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: #0f4c5c;
    color: white;
    font-weight: 600;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
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

.status {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    color: white;
}

.menunggu {
    background: orange;
}

.disetujui {
    background: green;
}

.ditolak {
    background: red;
}
</style>

<div class="title">Tukar Jadwal Piket</div>

@if(session('success'))
<div class="alert-success">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert-danger">
    {{ $errors->first() }}
</div>
@endif

<div class="tabs">
    <button class="tab-btn active" onclick="showTab('form', event)">
        Ajukan Tukar
    </button>

    <button class="tab-btn" onclick="showTab('status', event)">
        Status Pengajuan
    </button>
</div>

<div id="form" class="tab-content active">
    <div class="card">
        <h3>Ajukan Tukar Jadwal</h3><br>
        <form action="{{ route('tukar.simpan') }}"
              method="POST">

            @csrf
            <div class="input-group">
                <label><b>Jadwal Awal</b></label>
                <select name="jadwal_awal_id" required>
                    <option value="">
                        -- Pilih Jadwal Awal --
                    </option>
                    @foreach($jadwal as $item)

                    <option value="{{ $item->id }}">

                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        -
                        {{ $item->laboratorium->nama_lab }}
                        -
                        {{ date('H:i', strtotime($item->jam_mulai)) }}
                        s/d
                        {{ date('H:i', strtotime($item->jam_selesai)) }}

                    </option>

                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label><b>Jadwal Pengganti</b></label>
                <select name="jadwal_pengganti_id" required>
                    <option value="">
                        -- Pilih Jadwal Pengganti --
                    </option>

                    @foreach($jadwalKosong as $item)

                    <option value="{{ $item->id }}">
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        -
                        {{ $item->laboratorium->nama_lab }}
                        -
                        {{ date('H:i', strtotime($item->jam_mulai)) }}
                        s/d
                        {{ date('H:i', strtotime($item->jam_selesai)) }}
                    </option>

                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label><b>Alasan Tukar Jadwal</b></label>
                <textarea name="alasan" rows="4" placeholder="Masukkan alasan pengajuan..." required></textarea>
            </div>

            <button type="submit" class="btn">
                Ajukan Tukar Jadwal
            </button>
        </form>
    </div>
</div>

<div id="status" class="tab-content">
    <div class="card">
        <h3>Status Pengajuan</h3>

        <table>
            <thead>
                <tr>
                    <th>Jadwal Lama</th>
                    <th>Jadwal Baru</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pengajuan as $item)
                <tr>
                    <td>
                        {{ \Carbon\Carbon::parse($item->jadwalAwal->tanggal)->translatedFormat('d F Y') }}
                        <br>

                        <small>
                            {{ date('H:i', strtotime($item->jadwalAwal->jam_mulai)) }}
                            -
                            {{ date('H:i', strtotime($item->jadwalAwal->jam_selesai)) }}
                            •
                            {{ $item->jadwalAwal->laboratorium->nama_lab }}
                        </small>
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->jadwalPengganti->tanggal)->translatedFormat('d F Y') }}
                        <br>
                        <small>
                            {{ date('H:i', strtotime($item->jadwalPengganti->jam_mulai)) }}
                            -
                            {{ date('H:i', strtotime($item->jadwalPengganti->jam_selesai)) }}
                            •
                            {{ $item->jadwalPengganti->laboratorium->nama_lab }}
                        </small>
                    </td>

                    <td>
                        @if($item->status == 'Pending')
                            <span class="status menunggu">
                                Menunggu
                            </span>
                        @elseif($item->status == 'Disetujui')
                            <span class="status disetujui">
                                Disetujui
                            </span>
                        @else
                            <span class="status ditolak">
                                Ditolak
                            </span>
                        @endif
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="3"
                        style="text-align:center;">
                        Belum ada pengajuan tukar jadwal
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function showTab(tab, event)
{
    document.querySelectorAll('.tab-content')
        .forEach(el => el.classList.remove('active'));

    document.querySelectorAll('.tab-btn')
        .forEach(el => el.classList.remove('active'));

    document.getElementById(tab)
        .classList.add('active');

    event.target.classList.add('active');
}
</script>

@endsection