<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // LOGIN MAHASISWA
    public function loginMahasiswa()
    {
        return view('mahasiswa.login_mahasiswa');
    }

    // LOGIN ADMIN
    public function loginAdmin()
    {
        return view('admin.login_admin');
    }

    // REGISTRASI MAHASISWA
    public function registerMahasiswa()
    {
        return view('mahasiswa.register_mahasiswa');
    }

    // PROSES LOGIN MAHASISWA 
    public function prosesLoginMahasiswa(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'nim' => $request->nim,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'mahasiswa') {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }
            Auth::logout();
            return back()->with('loginError', 'Akses ditolak! Anda bukan mahasiswa.');
        }

        return back()->with('loginError', 'NIM atau Password salah!');
    }

    // PROSES LOGIN ADMIN
    public function prosesLoginAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }
            Auth::logout();
            return back()->with('loginError', 'Akses ditolak! Anda bukan Admin.');
        }

        return back()->with('loginError', 'Username atau Password Admin salah!');
    }

    // PROSES REGISTRASI MAHASISWA
    public function prosesRegisterMahasiswa(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nim' => 'required|string|max:30|unique:users',
            'password' => 'required|string|min:8',
            'prodi' => 'required|string|max:100',
            'semester' => 'required|string|max:20',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'password' => bcrypt($request->password), 
            'role' => 'mahasiswa', 
            'prodi' => $request->prodi,
            'semester' => $request->semester,
        ]);

        return redirect()->route('login.mahasiswa')->with('successMessage', 'Registrasi berhasil! Silakan masukkan NIM dan Password Anda untuk login.');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}