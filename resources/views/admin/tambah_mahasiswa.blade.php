@extends('layouts.app2')
@section('content')

<style>
.page-header{
    margin-bottom:25px;
}

.page-title{
    font-size:30px;
    font-weight:700;
    color:#0B3D4B;
}

.subtitle{
    margin-top:5px;
    font-size:14px;
    color:#777;
}

.card{
    width:100%;
    background:#fff;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:600;
    color:#333;
}

.form-control{
    width:100%;
    padding:14px 16px;
    border:1px solid #dcdcdc;
    border-radius:12px;
    font-size:14px;
    background:#fff;
    transition:all .2s ease;
}

.form-control:focus{
    outline:none;
    border-color:#0089AF;
    box-shadow:0 0 0 4px rgba(0,137,175,0.15);
}

.button-group{
    display:flex;
    justify-content:flex-end;
    gap:12px;
    margin-top:30px;
}

.btn-back{
    padding:12px 24px;
    border-radius:12px;
    background:#e9ecef;
    color:#333;
    text-decoration:none;
    font-weight:600;
}

.btn-back:hover{
    background:#d8dde2;
}

.btn-save{
    padding:12px 24px;
    border:none;
    border-radius:12px;
    background:#0B3D4B;
    color:#fff;
    font-weight:600;
    cursor:pointer;
}

.btn-save:hover{
    opacity:0.95;
    transform:translateY(-2px);
}

.required{
    color:red;
}
</style>

<div class="page-header">
    <div class="page-title">Tambah Mahasiswa</div>
    <div class="subtitle">
        Tambahkan data mahasiswa baru ke dalam sistem SIPiLAB
    </div>
</div>

<div class="card">
    <form action="{{ route('admin.mahasiswa.simpan') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Mahasiswa <span class="required">*</span></label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email <span class="required">*</span></label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>NIM <span class="required">*</span></label>
            <input type="text" name="nim" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Program Studi <span class="required">*</span></label>
            <select name="prodi" class="form-control" required>
                <option value="">-- Pilih Program Studi --</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Teknologi Rekayasa Multimedia">Teknologi Rekayasa Multimedia</option>
                <option value="Rekayasa Keamanan Siber">Rekayasa Keamanan Siber</option>
                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                <option value="Akuntansi Lembaga Keuangan Syariah">Akuntansi Lembaga Keuangan Syariah</option>
            </select>
        </div>

        <div class="form-group">
            <label>Semester <span class="required">*</span></label>
            <select name="semester" class="form-control" required>
                <option value="">-- Pilih Semester --</option>
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
                <option value="3">Semester 3</option>
                <option value="4">Semester 4</option>
                <option value="5">Semester 5</option>
                <option value="6">Semester 6</option>
                <option value="7">Semester 7</option>
                <option value="8">Semester 8</option>
            </select>
        </div>

        <div class="button-group">
            <a href="/admin/mahasiswa" class="btn-back">
                Kembali
            </a>

            <button type="submit" class="btn-save">
                Simpan Mahasiswa
            </button>
        </div>
    </form>
</div>

@endsection