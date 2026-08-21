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
    margin-bottom:20px;
}

.card{
    background:white;
    padding:25px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.05);
}

.top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.search{
    width:300px;
    padding:12px 15px;
    border:1px solid #ddd;
    border-radius:12px;
    outline:none;
}

.search:focus{
    border-color:#00a8a8;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#f8fafc;
    padding:14px;
    text-align:left;
    color:#666;
}

td{
    padding:14px;
    border-top:1px solid #eee;
}

tr:hover{
    background:#fafcff;
}

.img-proof{
    width:60px;
    height:60px;
    object-fit:cover;
    border-radius:10px;
    cursor:pointer;
}

.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.badge-hadir{
    background:#d1f7e5;
    color:#198754;
}

.badge-terlambat{
    background:#fff3cd;
    color:#856404;
}

.badge-tidak{
    background:#f8d7da;
    color:#842029;
}

.empty{
    text-align:center;
    color:#888;
    padding:30px;
}

/* Modal */
.modal-img{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.7);
    justify-content:center;
    align-items:center;
    z-index:999;
}

.modal-img img{
    max-width:80%;
    max-height:80%;
    border-radius:10px;
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

    <div class="title">
        Rekap Absensi Mahasiswa
    </div>

    <div class="card">
        <div class="top">
            <form action="/admin/absensi" method="GET">
                <input type="text" name="search" class="search" placeholder="Cari nama / NIM..." value="{{ request('search') }}">
            </form>

        </div>
        <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Mahasiswa</th>
                    <th>NIM</th>
                    <th>Tanggal</th>
                    <th>Jam Absen</th>
                    <th>Lab</th>
                    <th>Bukti</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
            @forelse($absensi as $a)
                <tr>
                    <td>
                        {{ $a->mahasiswa->name ?? '-' }}
                    </td>
                    <td>
                        {{ $a->mahasiswa->nim ?? '-' }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}
                    </td>
                    <td>
                        {{ date('H:i', strtotime($a->jam_absen)) }}
                    </td>
                    <td>
                        {{ $a->jadwal->laboratorium->nama_lab ?? '-' }}
                    </td>
                    <td>
                        @if($a->bukti_foto)
                            <img src="{{ asset('uploads/absensi/'.$a->bukti_foto) }}" class="img-proof" onclick="showImage(this.src)">
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if($a->status == 'Hadir')
                            <span class="badge badge-hadir">Hadir</span>
                        @elseif($a->status == 'Terlambat')
                            <span class="badge badge-terlambat">Terlambat</span>
                        @else
                            <span class="badge badge-tidak">Tidak Hadir</span>
                        @endif
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7" class="empty">
                        Belum ada data absensi
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>
</div>

<div id="modalImg" class="modal-img" onclick="closeImg()">
    <img id="imgPreview">
</div>

<script>
function showImage(src){
    document.getElementById('modalImg').style.display='flex';
    document.getElementById('imgPreview').src=src;
}

function closeImg(){
    document.getElementById('modalImg').style.display='none';
}
</script>

@endsection