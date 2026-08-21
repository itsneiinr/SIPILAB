@extends('layouts.app2')
@section('content')

<style>
.container{
    padding:20px;
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
    box-shadow:0 10px 25px rgba(0,0,0,0.06);
}

.alert-success{
    background:#d4edda;
    color:#155724;
    padding:12px 15px;
    border-radius:10px;
    margin-bottom:20px;
    border:1px solid #c3e6cb;
}

.top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.search{
    width:250px;
    padding:12px;
    border:1px solid #ddd;
    border-radius:12px;
    outline:none;
}

.search:focus{
    border-color:#0089AF;
}

.btn{
    padding:10px 18px;
    border:none;
    border-radius:12px;
    background:#0B3D4B;
    color:white;
    text-decoration:none;
    font-weight:600;
    cursor:pointer;
}

.btn:hover{
    opacity:.9;
}

.btn-edit{
    background:#17a2b8;
}

.btn-edit:hover{
    background:#138496;
}

.btn-danger{
    background:#ff5c5c;
}

.btn-danger:hover{
    background:#e74c3c;
}

.action{
    display:flex;
    gap:8px;
}

table{
    width:100%;
    border-collapse:collapse;
}

thead{
    background:#f7f9fc;
}

th{
    padding:15px;
    text-align:left;
    color:#555;
    font-size:14px;
    border-bottom:2px solid #eee;
}

td{
    padding:15px;
    border-bottom:1px solid #eee;
}

tbody tr:hover{
    background:#f9fbff;
}

.empty{
    text-align:center;
    color:#999;
    padding:30px;
}

.table-responsive{
    overflow-x:auto;
    width:100%;
}

@media(max-width:768px){

    .top{
        flex-direction:column;
        align-items:stretch;
        gap:10px;
    }

    .search-form{
        width:100%;
        flex-direction:column;
    }

    .search{
        width:100%;
    }

    .btn,
    .btn-add,
    .btn-search{
        width:100%;
        text-align:center;
    }

    .action{
        flex-direction:column;
    }
}
</style>

<div class="container">
    <div class="title">Manajemen Mahasiswa</div>
    <div class="subtitle">Kelola data mahasiswa SIPiLAB</div>
    <div class="card">
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="top">
            <form method="GET" action="/admin/mahasiswa" style="display:flex; gap:10px;">
                <input type="text" name="search" class="search" placeholder="Cari nama / NIM..." value="{{ request('search') }}">
                <button type="submit" class="btn">Cari</button>
            </form>
            <a href="{{ route('admin.mahasiswa.tambah') }}" class="btn">
                + Tambah Mahasiswa
            </a>
        </div>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Semester</th>
                        <th>Program Studi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($mahasiswa as $mhs)
                    <tr>
                        <td>
                            <strong>{{ $mhs->name }}</strong>
                        </td>
                        <td>{{ $mhs->nim }}</td>
                        <td>{{ $mhs->semester }}</td>
                        <td>{{ $mhs->prodi }}</td>
                        <td>
                            <div class="action">
                                <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}" class="btn btn-edit">
                                    Edit
                                </a>
                                <a href="{{ route('admin.mahasiswa.hapus', $mhs->id) }}" class="btn btn-danger"
                                onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="empty">Belum ada data mahasiswa.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection