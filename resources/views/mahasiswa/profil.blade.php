@extends('layouts.app')
@section('content')

<style>
.title {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 20px;
}

.profile-wrapper {
    display: flex;
    justify-content: center;
}

.profile-card {
    width: 100%;
    max-width: 850px;
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.profile-img {
    text-align: center;
    margin-bottom: 20px;
}

.profile-img img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
}

.upload-btn {
    display: none;
    margin-top: 10px;
    font-size: 13px;
    color: #0f4c5c;
    cursor: pointer;
}

.input-group {
    margin-bottom: 15px;
}

.input-group label {
    font-size: 13px;
}

.input-group input {
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
    margin-top: 10px;
    cursor: pointer;
}

.btn-secondary {
    background: #ccc;
    color: black;
}
</style>

<div class="title">Profil Mahasiswa</div>
<div class="profile-wrapper">
    <div class="profile-card">
        <form action="{{ route('profil.update') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            <div class="profile-img">
            <img id="previewFoto"
                src="{{ $user->foto_profil
                        ? asset('uploads/profil/'.$user->foto_profil)
                        : asset('images/default-user.png') }}"
                alt="Foto Profil">                
                <input type="file" name="foto_profil" id="foto" hidden>
                <label for="foto" class="upload-btn" id="uploadLabel">Ganti Foto</label>

                <h3 id="namaText">{{ $user->name }}</h3>
                <p style="color: gray; font-size: 14px;">{{ $user->nim }}</p>
            </div>

            <div class="input-group">
                <label><b>Nama Mahasiswa</b></label>
                <input type="text" id="namaInput" name="name" value="{{ $user->name }}" readonly>
            </div>

            <div class="input-group">
                <label><b>NIM</b></label>
                <input type="number" id="nimInput" value="{{ $user->nim }}" readonly>
            </div>

            <div class="input-group">
                <label><b>Email</b></label>
                <input type="email" id="emailInput" name="email" value="{{ $user->email }}" readonly>
            </div>

            <div class="input-group">
                <label><b>Program Studi</b></label>
                <input type="text" value="{{ $user->prodi }}" readonly>
            </div>

            <div class="input-group">
                <label><b>Semester</b></label>
                <input type="text" value="{{ $user->semester }}" readonly>
            </div>

            <div class="input-group">
                <label><b>Password Baru</b></label>
                <input type="password" id="passwordInput" name="password" placeholder="Kosongkan jika tidak diubah" readonly>
            </div>

            <button type="button" class="btn" id="editBtn">Edit Profil</button>
            <button type="submit" class="btn" id="saveBtn" style="display:none;">Simpan Perubahan</button>
            <button type="button" class="btn btn-secondary" id="cancelBtn" style="display:none;">Batal</button>
        </form>
    </div>
</div>

<script>
let editBtn = document.getElementById("editBtn");
let saveBtn = document.getElementById("saveBtn");
let cancelBtn = document.getElementById("cancelBtn");

let inputs = [
    document.getElementById("namaInput"),
    document.getElementById("emailInput"),
    document.getElementById("passwordInput")
];

let uploadLabel = document.getElementById("uploadLabel");

editBtn.onclick = function() {
    inputs.forEach(i => i.removeAttribute("readonly"));

    editBtn.style.display = "none";
    saveBtn.style.display = "block";
    cancelBtn.style.display = "block";
    uploadLabel.style.display = "block";
};

cancelBtn.onclick = function() {
    inputs.forEach(i => i.setAttribute("readonly", true));
    editBtn.style.display = "block";
    saveBtn.style.display = "none";
    cancelBtn.style.display = "none";
    uploadLabel.style.display = "none";
};

document.getElementById("foto").addEventListener("change", function(e) {
    let reader = new FileReader();
    reader.onload = function() {
        document.getElementById("previewFoto").src = reader.result;
    }
    reader.readAsDataURL(e.target.files[0]);
});
</script>

@endsection