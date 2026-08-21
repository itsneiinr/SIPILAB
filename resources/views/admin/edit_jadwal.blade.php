@extends('layouts.app2')
@section('content')

<style>

.container{
    padding:25px;
}

.page-title{
    font-size:30px;
    font-weight:700;
    color:#0B3D4B;
    margin-bottom:20px;
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
    font-weight:600;
}

.form-control{
    width:100%;
    padding:14px;
    border:1px solid #ddd;
    border-radius:12px;
}

.row{
    display:flex;
    gap:15px;
}

.half{
    flex:1;
}

.button-group{
    margin-top:25px;
    display:flex;
    justify-content:flex-end;
    gap:10px;
}

.btn-back{
    padding:12px 20px;
    border-radius:12px;
    text-decoration:none;
    background:#e9ecef;
    color:#333;
}

.btn-save{
    padding:12px 20px;
    border:none;
    border-radius:12px;
    background:#0B3D4B;
    color:white;
    cursor:pointer;
}
</style>

<div class="container">
    <div class="page-title">Edit Jadwal Piket</div>

    <div class="card">
        <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Mahasiswa</label>
                <select name="user_id" class="form-control" required>
                    @foreach($mahasiswa as $mhs)
                    <option
                        value="{{ $mhs->id }}"
                        {{ $jadwal->user_id == $mhs->id ? 'selected' : '' }}>
                        {{ $mhs->name }}
                        ({{ $mhs->nim }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Laboratorium</label>
                <select name="laboratorium_id" class="form-control" required>
                    @foreach($laboratorium as $lab)
                    <option
                        value="{{ $lab->id }}"
                        {{ $jadwal->laboratorium_id == $lab->id ? 'selected' : '' }}>
                        {{ $lab->nama_lab }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $jadwal->tanggal }}" required>
            </div>

            <div class="row">
                <div class="form-group half">
                    <label>Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}" required>
                </div>

                <div class="form-group half">
                    <label>Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}" required>
                </div>
            </div>

            <div class="button-group">
                <a href="/admin/jadwal" class="btn-back">Kembali</a>
                <button type="submit" class="btn-save">Update Jadwal</button>
            </div>
        </form>
    </div>
</div>

@endsection