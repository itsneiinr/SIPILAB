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

.card{
    background:#fff;
    padding:25px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.05);
}

.top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    gap:15px;
}

.search-form{
    display:flex;
    gap:10px;
}

.search{
    width:320px;
    padding:12px 15px;
    border:1px solid #ddd;
    border-radius:12px;
    outline:none;
}

.search:focus{
    border-color:#00a8a8;
}

.btn{
    padding:10px 18px;
    border:none;
    border-radius:12px;
    color:white;
    cursor:pointer;
    text-decoration:none;
    font-weight:600;
    display:inline-block;
    text-align:center;
}

.btn-search{
    background:#0B3D4B;
}

.btn-add{
    background:#0B3D4B;
}

.btn-edit{
    background:#17a2b8;
}

.btn-danger{
    background:#ff5c5c;
}

table{
    width:100%;
    border-collapse:collapse;
}

thead{
    background:#f5f7fa;
}

th{
    padding:15px;
    text-align:left;
    color:#666;
    font-weight:700;
}

td{
    padding:15px;
    border-top:1px solid #eee;
    vertical-align:middle;
}

tbody tr:hover{
    background:#fafcff;
}

.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.badge-aktif{
    background:#d1f7e5;
    color:#198754;
}

.badge-selesai{
    background:#ececec;
    color:#666;
}

.action{
    display:flex;
    gap:8px;
}

.empty{
    text-align:center;
    color:#888;
    padding:30px;
}

.alert-success{
    background:#d1f7e5;
    color:#198754;
    padding:15px;
    border-radius:12px;
    margin-bottom:20px;
}

.nama{
    font-weight:600;
    color:#222;
}

.table-responsive{
    overflow-x:auto;
    width:100%;
}

@media(max-width:768px){

    .top{
        flex-direction:column;
        align-items:stretch;
    }

    .search-form{
        width:100%;
    }

    .search{
        width:100%;
    }

    table{
        min-width:900px;
    }

    .action{
        flex-direction:column;
    }
}
</style>

<div class="container">
    <div class="title">
        Manajemen Jadwal Piket
    </div>
    <div class="subtitle">Kelola jadwal piket mahasiswa SIPiLAB</div>
    
    <div class="card">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="top">
            <form action="/admin/jadwal" method="GET" class="search-form">
                <input type="text" name="search" class="search" placeholder="Cari mahasiswa / NIM..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-search">Cari</button>
            </form>
            <a href="/admin/tambah_jadwal" class="btn btn-add">+ Tambah Jadwal</a>
        </div>

        <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Mahasiswa</th>
                    <th>NIM</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Laboratorium</th>
                    <th>Status</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($jadwal as $j)
                <tr>
                    <td class="nama">
                        {{ $j->mahasiswa->name ?? '-' }}
                    </td>

                    <td>
                        {{ $j->mahasiswa->nim ?? '-' }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($j->tanggal)->format('d M Y') }}
                    </td>

                    <td>
                        {{ date('H:i', strtotime($j->jam_mulai)) }}
                        -
                        {{ date('H:i', strtotime($j->jam_selesai)) }}
                    </td>

                    <td>
                        {{ $j->laboratorium->nama_lab ?? '-' }}
                    </td>

                    <td>
                        @if($j->status == 'Aktif')
                            <span class="badge badge-aktif">Aktif</span>
                        @else
                            <span class="badge badge-selesai">{{ $j->status }}</span>
                        @endif

                    </td>

                    <td>
                        <div class="action">
                            <a href="{{ route('admin.jadwal.edit',$j->id) }}" class="btn btn-edit">
                                Edit
                            </a>

                            <a href="{{ route('admin.jadwal.hapus',$j->id) }}" class="btn btn-danger"
                               onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                Hapus
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty">Belum ada data jadwal piket</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection