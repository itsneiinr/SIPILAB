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

.btn-update{
    padding:12px 24px;
    border:none;
    border-radius:12px;
    background:#0B3D4B;
    color:#fff;
    font-weight:600;
    cursor:pointer;
}

.btn-update:hover{
    opacity:0.95;
    transform:translateY(-2px);
}

.required{
    color:red;
}
</style>

<div class="page-header">
    <div class="page-title">
        Edit Mahasiswa
    </div>

    <div class="subtitle">
        Perbarui data mahasiswa pada sistem SIPiLAB
    </div>
</div>

<div class="card">
    <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Mahasiswa <span class="required">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ $mahasiswa->name }}" required>
        </div>

        <div class="form-group">
            <label>Email <span class="required">*</span></label>
            <input type="email" name="email" class="form-control" value="{{ $mahasiswa->email }}" required>
        </div>

        <div class="form-group">
            <label>NIM <span class="required">*</span></label>
            <input type="text" name="nim" class="form-control" value="{{ $mahasiswa->nim }}" required>
        </div>

        <div class="form-group">
            <label>Program Studi <span class="required">*</span></label>
            <select name="prodi" class="form-control" required>
                <option value="Teknik Informatika"
                    {{ $mahasiswa->prodi == 'Teknik Informatika' ? 'selected' : '' }}>
                    Teknik Informatika
                </option>

                <option value="Teknologi Rekayasa Multimedia"
                    {{ $mahasiswa->prodi == 'Teknologi Rekayasa Multimedia' ? 'selected' : '' }}>
                    Teknologi Rekayasa Multimedia
                </option>

                <option value="Rekayasa Keamanan Siber"
                    {{ $mahasiswa->prodi == 'Rekayasa Keamanan Siber' ? 'selected' : '' }}>
                    Rekayasa Keamanan Siber
                </option>

                <option value="Rekayasa Perangkat Lunak"
                    {{ $mahasiswa->prodi == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>
                    Rekayasa Perangkat Lunak
                </option>

                <option value="Akuntansi Lembaga Keuangan Syariah"
                    {{ $mahasiswa->prodi == 'Akuntansi Lembaga Keuangan Syariah' ? 'selected' : '' }}>
                    Akuntansi Lembaga Keuangan Syariah
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>Semester <span class="required">*</span></label>
            <select name="semester" class="form-control" required>
                @for($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}"
                        {{ $mahasiswa->semester == $i ? 'selected' : '' }}>
                        Semester {{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="button-group">
            <a href="/admin/mahasiswa" class="btn-back">
                Kembali
            </a>

            <button type="submit" class="btn-update">
                Update Mahasiswa
            </button>
        </div>
    </form>
</div>

@endsection