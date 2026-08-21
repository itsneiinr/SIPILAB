<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcomesipilab');
});

// MAHASISWA
Route::get('/login_mahasiswa', [AuthController::class, 'loginMahasiswa'])->name('login.mahasiswa');
Route::post('/login_mahasiswa', [AuthController::class, 'prosesLoginMahasiswa'])->name('login.mahasiswa.proses');
Route::get('/register_mahasiswa', [AuthController::class, 'registerMahasiswa'])->name('register.mahasiswa');
Route::post('/register_mahasiswa', [AuthController::class, 'prosesRegisterMahasiswa'])->name('register.mahasiswa.proses');
Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
Route::get('/jadwal', [MahasiswaController::class, 'jadwal']);
Route::get('/tukar', [MahasiswaController::class, 'tukar']);
Route::post('/tukar-jadwal', [MahasiswaController::class, 'simpanTukar'])->name('tukar.simpan');
Route::get('/absensi', [MahasiswaController::class, 'absensi']);
Route::post('/absensi/simpan', [MahasiswaController::class, 'simpanAbsensi'])->name('absensi.simpan');
Route::get('/profil', [MahasiswaController::class, 'profil']);
Route::post('/profil/update', [MahasiswaController::class,'updateProfil'])->name('profil.update');

// ADMIN
Route::get('/login_admin', [AuthController::class, 'loginAdmin'])->name('login.admin');
Route::post('/login_admin', [AuthController::class, 'prosesLoginAdmin'])->name('login.admin.proses');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/jadwal', [AdminController::class, 'jadwal']);
Route::get('/admin/tambah_jadwal', [AdminController::class, 'tambah_jadwal']);
Route::post('/admin/jadwal/simpan',[AdminController::class, 'simpanJadwal'])->name('admin.jadwal.simpan');
Route::get('/admin/jadwal/edit/{id}',[AdminController::class, 'editJadwal'])->name('admin.jadwal.edit');
Route::post('/admin/jadwal/update/{id}',[AdminController::class, 'updateJadwal'])->name('admin.jadwal.update');
Route::get('/admin/jadwal/hapus/{id}',[AdminController::class, 'hapusJadwal'])->name('admin.jadwal.hapus');
Route::get('/admin/tukar', [AdminController::class, 'tukar']);
Route::post('/admin/tukar/{id}/setujui', [AdminController::class, 'setujuiTukar'])->name('admin.tukar.setujui');
Route::post('/admin/tukar/{id}/tolak', [AdminController::class, 'tolakTukar'])->name('admin.tukar.tolak');
Route::get('/admin/mahasiswa', [AdminController::class, 'mahasiswa']);
Route::get('/admin/mahasiswa/tambah', [AdminController::class, 'tambahMahasiswa'])->name('admin.mahasiswa.tambah');
Route::post('/admin/mahasiswa/simpan', [AdminController::class, 'simpanMahasiswa'])->name('admin.mahasiswa.simpan');
Route::get('/admin/mahasiswa/edit/{id}', [AdminController::class, 'editMahasiswa'])->name('admin.mahasiswa.edit');
Route::post('/admin/mahasiswa/update/{id}', [AdminController::class, 'updateMahasiswa'])->name('admin.mahasiswa.update');
Route::get('/admin/mahasiswa/hapus/{id}', [AdminController::class, 'hapusMahasiswa'])->name('admin.mahasiswa.hapus');
Route::get('/admin/absensi', [AdminController::class, 'absensi']);

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');