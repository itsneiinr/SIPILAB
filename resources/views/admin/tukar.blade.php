@extends('layouts.app2')
@section('content')

<style>
.container{
    padding:25px;
}

.title{
    font-size:28px;
    font-weight:700;
    color:#0B3D4B;
    margin-bottom:5px;
}

.subtitle{
    color:#777;
    font-size:14px;
    margin-bottom:20px;
}

.alert-success{
    background:#d4edda;
    color:#155724;
    padding:12px;
    border-radius:10px;
    margin-bottom:15px;
}

.card{
    margin-top:20px;
    background:white;
    padding:25px;
    border-radius:18px;
    box-shadow:0 12px 30px rgba(0,0,0,0.05);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    text-align:left;
    padding:14px;
    color:#777;
    background:#f8fafc;
}

td{
    padding:14px;
    vertical-align:top;
}

tr{
    border-top:1px solid #eee;
}

tr:hover{
    background:#f9fbff;
}

.btn{
    padding:8px 12px;
    border:none;
    border-radius:10px;
    background:#0089AF;
    color:white;
    cursor:pointer;
}

.btn:hover{
    opacity:0.9;
}

.btn-red{
    background:#ff5c5c;
}

.detail{
    font-size:13px;
    color:#555;
    line-height:1.6;
}

.status-pending{
    color:orange;
    font-weight:bold;
}

.status-setuju{
    color:green;
    font-weight:bold;
}

.status-tolak{
    color:red;
    font-weight:bold;
}

.empty{
    text-align:center;
    color:#999;
    padding:30px;
}
</style>

<div class="container">
    <div class="title">Manajemen Tukar Jadwal Piket</div>
    <div class="subtitle">
        Kelola tukar jadwal piket mahasiswa SIPiLAB
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th width="20%">Mahasiswa</th>
                    <th width="55%">Detail Pengajuan</th>
                    <th width="25%">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pengajuan as $item)
                <tr>
                    <td>
                        <b>{{ $item->mahasiswa->name ?? '-' }}</b>
                        <br>

                        <small>
                            {{ $item->mahasiswa->nim ?? '-' }}
                        </small>
                    </td>

                    <td class="detail">
                        <b>Jadwal Awal:</b><br>
                        @if($item->jadwalAwal)
                            {{ \Carbon\Carbon::parse($item->jadwalAwal->tanggal)->translatedFormat('d F Y') }}
                            <br>

                            <small>
                                {{ date('H:i', strtotime($item->jadwalAwal->jam_mulai)) }}
                                -
                                {{ date('H:i', strtotime($item->jadwalAwal->jam_selesai)) }}
                                •
                                {{ $item->jadwalAwal->laboratorium->nama_lab ?? '-' }}
                            </small>
                        @else
                            <span style="color:red">
                                Jadwal awal tidak ditemukan
                            </span>
                        @endif
                        <br><br>

                        <b>Jadwal Pengganti:</b><br>
                        @if($item->jadwalPengganti)
                            {{ \Carbon\Carbon::parse($item->jadwalPengganti->tanggal)->translatedFormat('d F Y') }}
                            <br>

                            <small>
                                {{ date('H:i', strtotime($item->jadwalPengganti->jam_mulai)) }}
                                -
                                {{ date('H:i', strtotime($item->jadwalPengganti->jam_selesai)) }}
                                •
                                {{ $item->jadwalPengganti->laboratorium->nama_lab ?? '-' }}
                            </small>
                        @else
                            <span style="color:red">
                                Jadwal pengganti tidak ditemukan
                            </span>
                        @endif
                        <br><br>

                        <b>Alasan:</b><br>
                        {{ $item->alasan }}
                    </td>

                    <td>
                        @if($item->status == 'Pending')
                            <form action="{{ route('admin.tukar.setujui',$item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn">
                                    ✔ Setujui
                                </button>
                            </form>

                            <br>
                            <form action="{{ route('admin.tukar.tolak',$item->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="btn btn-red">
                                    ✖ Tolak
                                </button>
                            </form>
                        @elseif($item->status == 'Disetujui')
                            <span class="status-setuju">
                                ✔ Disetujui
                            </span>
                        @else
                            <span class="status-tolak">
                                ✖ Ditolak
                            </span>
                        @endif
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="3" class="empty">
                        Belum ada pengajuan tukar jadwal
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection