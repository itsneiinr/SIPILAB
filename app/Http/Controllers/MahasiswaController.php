<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPiket;
use App\Models\TukarJadwal;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    // DASHBOARD
    public function dashboard()
    {
        if (auth()->user()->role != 'mahasiswa') {
        abort(403);
    }
    $user = Auth::user();

    // jumlah jadwal milik mahasiswa
    $jumlahJadwal = JadwalPiket::where(
        'user_id',
        $user->id
    )->count();

    // jumlah absensi mahasiswa
    $jumlahAbsensi = Absensi::where(
        'user_id',
        $user->id
    )->count();

    // jumlah pengajuan tukar yang masih pending
    $jumlahTukarPending = TukarJadwal::where(
        'user_id',
        $user->id
    )
    ->where('status', 'Pending')
    ->count();

    // jadwal hari ini
    $jadwalHariIni = JadwalPiket::with('laboratorium')
        ->where('user_id', $user->id)
        ->whereDate('tanggal', now()->toDateString())
        ->first();

    return view(
        'mahasiswa.dashboard',
        compact(
            'user',
            'jumlahJadwal',
            'jumlahAbsensi',
            'jumlahTukarPending',
            'jadwalHariIni'
            )
        );
    }

    // JADWAL PIKET
    public function jadwal()
    {
        $user = Auth::user();
        $jadwal = JadwalPiket::with('laboratorium')
            ->where('user_id', $user->id)
            ->orderBy('tanggal', 'asc')
            ->get();

        return view(
            'mahasiswa.jadwal',
            compact('jadwal')
        );    
    }

    // TUKAR JADWAL
    public function tukar()
    {
        $user = Auth::user();

        // jadwal mahasiswa
        $jadwal = JadwalPiket::with('laboratorium')
            ->where('user_id', $user->id)
            ->orderBy('tanggal')
            ->get();

        // slot kosong
        $jadwalKosong = JadwalPiket::with('laboratorium')
            ->whereNull('user_id')
            ->orderBy('tanggal')
            ->get();

        // riwayat pengajuan
        $pengajuan = TukarJadwal::with([
            'jadwalAwal.laboratorium',
            'jadwalPengganti.laboratorium'
        ])
        ->where('user_id', $user->id)
        ->latest()
        ->get();

        return view('mahasiswa.tukar', compact(
            'jadwal',
            'jadwalKosong',
            'pengajuan'
        ));
    }

    // SIMPAN TUKAR JADWAL
    public function simpanTukar(Request $request)
    {
        $request->validate([
            'jadwal_awal_id' => 'required',
            'jadwal_pengganti_id' => 'required',
            'alasan' => 'required'
        ]);
        if ($request->jadwal_awal_id == $request->jadwal_pengganti_id) {

            return back()->withErrors([
                'Jadwal awal dan jadwal pengganti tidak boleh sama'
            ]);
        }
        $cek = TukarJadwal::where(
            'user_id',
            Auth::id()
        )
        ->where(
            'jadwal_awal_id',
            $request->jadwal_awal_id
        )
        ->where(
            'status',
            'Pending'
        )
        ->exists();

        if ($cek) {

            return back()->withErrors([
                'Jadwal ini masih memiliki pengajuan yang menunggu persetujuan admin'
            ]);
        }
        TukarJadwal::create([
            'user_id' => Auth::id(),
            'jadwal_awal_id' => $request->jadwal_awal_id,
            'jadwal_pengganti_id' => $request->jadwal_pengganti_id,
            'alasan' => $request->alasan,
            'status' => 'Pending'
        ]);

        return back()->with(
            'success',
            'Pengajuan tukar jadwal berhasil dikirim'
        );
    }

    // ABSENSI
    public function absensi()
    {
        $user = Auth::user();

        $jadwalHariIni = JadwalPiket::with('laboratorium')
            ->where('user_id', $user->id)
            ->whereDate('tanggal', now()->toDateString())
            ->where('status', 'Aktif')
            ->first();

        $sudahAbsen = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', now()->toDateString())
            ->exists();

        $riwayat = Absensi::where('user_id', $user->id)
                ->orderBy('tanggal', 'desc')
                ->get();
                
        return view(
            'mahasiswa.absensi',
            compact(
                'jadwalHariIni',
                'sudahAbsen',
                'riwayat'
            )
        );
    }

    // SIMPAN ABSENSI
    public function simpanAbsensi(Request $request)
    {
        $request->validate([
            'bukti_foto' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ]);
        $user = Auth::user();
        $jadwalHariIni = JadwalPiket::where(
            'user_id',
            $user->id
        )
        ->whereDate('tanggal', now()->toDateString())
        ->first();

        if (!$jadwalHariIni) {
            return back()->with(
                'error',
                'Tidak ada jadwal piket hari ini'
            );
        }

        $cek = Absensi::where(
            'user_id',
            $user->id
        )
        ->whereDate('tanggal', now()->toDateString())
        ->exists();

        if ($cek) {
            return back()->with(
                'error',
                'Anda sudah melakukan absensi'
            );
        }
        $foto = $request->file('bukti_foto');
        $namaFoto = time().'_'.$foto->getClientOriginalName();
        $foto->move(
            public_path('uploads/absensi'),
            $namaFoto
        );
        Absensi::create([
            'user_id' => $user->id,
            'jadwal_piket_id' => $jadwalHariIni->id,
            'tanggal' => now()->toDateString(),
            'jam_absen' => now()->format('H:i:s'),
            'status' => 'Hadir',
            'bukti_foto' => $namaFoto
        ]);
        $jadwalHariIni->update([
            'status' => 'Selesai'
        ]);

        return back()->with(
            'success',
            'Absensi berhasil'
        );
    }

    // PROFIL
    public function profil()
    {
        $user = Auth::user();

            return view(
                'mahasiswa.profil',
                compact('user')
            );
    }

    // UPDATE PROFIL
    public function updateProfil(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);
        $user = Auth::user();
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        if($request->hasFile('foto_profil')){
            $foto = $request->file('foto_profil');
            $namaFoto =
                time().'_'.$foto->getClientOriginalName();
            $foto->move(
                public_path('uploads/profil'),
                $namaFoto
            );
            $data['foto_profil'] = $namaFoto;
        }
        $user->update($data);

        return back()->with(
            'success',
            'Profil berhasil diperbarui'
        );
    }
}