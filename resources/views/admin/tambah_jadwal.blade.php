@extends('layouts.app2')
@section('content')

<style>
.container{
    padding:25px;
}

.page-header{
    margin-bottom:25px;
}

.page-title{
    font-size:30px;
    font-weight:700;
    color:#0B3D4B;
}

.subtitle{
    color:#777;
    margin-top:5px;
    font-size:14px;
}

.card{
    width:100%;
    background:#fff;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

.alert-error{
    background:#ffe5e5;
    color:#c62828;
    padding:15px;
    border-radius:12px;
    margin-bottom:20px;
}

.alert-error ul{
    margin:0;
    padding-left:20px;
}

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#333;
}

.form-control{
    width:100%;
    padding:14px;
    border:1px solid #ddd;
    border-radius:12px;
    font-size:14px;
    transition:0.2s;
}

.form-control:focus{
    outline:none;
    border-color:#00a8a8;
    box-shadow:0 0 0 4px rgba(0,168,168,0.15);
}

.row{
    display:flex;
    gap:15px;
}

.half{
    flex:1;
}

.button-group{
    margin-top:30px;
    display:flex;
    justify-content:flex-end;
    gap:10px;
}

.btn-back{
    padding:12px 22px;
    border:none;
    border-radius:12px;
    background:#e9ecef;
    color:#333;
    text-decoration:none;
    font-weight:600;
}

.btn-back:hover{
    background:#dcdfe3;
}

.btn-save{
    padding:12px 22px;
    border:none;
    border-radius:12px;
    background:#0B3D4B;
    color:white;
    font-weight:600;
    cursor:pointer;
}

.btn-save:hover{
    transform:translateY(-2px);
}
</style>

<div class="container">
    <div class="page-header">
        <div class="page-title">Tambah Jadwal Piket</div>
        <div class="subtitle">
            Tambahkan jadwal piket mahasiswa ke dalam sistem SIPiLAB
        </div>
    </div>

    <div class="card">
        @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('admin.jadwal.simpan') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Mahasiswa</label>
                <select name="user_id" class="form-control" required>
                    <option value="">Pilih Mahasiswa</option>

                    @foreach($mahasiswa as $mhs)
                    <option value="{{ $mhs->id }}">
                        {{ $mhs->name }} ({{ $mhs->nim }})
                    </option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label>Laboratorium</label>
                <select name="laboratorium_id" class="form-control" required>
                    <option value="">Pilih Laboratorium</option>

                    @foreach($laboratorium as $lab)
                    <option value="{{ $lab->id }}">
                        {{ $lab->nama_lab }}
                    </option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="row">
                <div class="form-group half">
                    <label>Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" required>
                </div>

                <div class="form-group half">
                    <label>Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" required>
                </div>
            </div>

            <div class="button-group">
                <a href="/admin/jadwal" class="btn-back">Kembali</a>

                <button type="submit" class="btn-save">
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>

@endsection