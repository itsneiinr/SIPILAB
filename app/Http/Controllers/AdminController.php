<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JadwalPiket;
use App\Models\TukarJadwal;
use App\Models\Laboratorium;
use App\Models\Absensi;

class AdminController extends Controller
{
    // DASHBOARD
    public function dashboard()
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }
    
    // Total mahasiswa
    $totalMahasiswa = User::where('role', 'mahasiswa')->count();

    // Jadwal hari ini
    $jadwalHariIni = JadwalPiket::whereDate(
        'tanggal',
        now()->toDateString()
    )->count();

    // Sudah selesai piket hari ini
    $sudahPiketHariIni = JadwalPiket::whereDate(
        'tanggal',
        now()->toDateString()
    )
    ->where('status', 'Selesai')
    ->count();

    // Pengajuan tukar pending
    $pengajuanPending = TukarJadwal::where(
        'status',
        'Pending'
    )->count();

    // Jadwal terdekat
    $jadwalTerdekat = JadwalPiket::with([
        'mahasiswa',
        'laboratorium'
    ])
    ->whereNotNull('user_id')
    ->where('status', 'Aktif')
    ->whereDate('tanggal', '>=', now())
    ->orderBy('tanggal', 'asc')
    ->take(5)
    ->get();

    return view(
        'admin.dashboard',
        compact(
            'totalMahasiswa',
            'jadwalHariIni',
            'sudahPiketHariIni',
            'pengajuanPending',
            'jadwalTerdekat'
        )
    );
    }
    
    // JADWAL PIKET
    public function jadwal(Request $request)
    {
        $search = $request->search;
        $jadwal = JadwalPiket::with(['mahasiswa','laboratorium'])
        ->when($search, function($query) use ($search){
            
            $query->whereHas('mahasiswa', function($q) use ($search){

                $q->where('name','like',"%{$search}%")
                    ->orWhere('nim','like',"%{$search}%");
            });
        })
        ->get();

        return view('admin.jadwal', compact('jadwal'));
    }

    // TAMBAH JADWAL PIKET
    public function tambah_jadwal()
    {
        $mahasiswa = User::where('role','mahasiswa')->get();
        $laboratorium = Laboratorium::all();

        return view(
            'admin.tambah_jadwal',
            compact('mahasiswa','laboratorium')
        );
    }

    // SIMPAN JADWAL PIKET
    public function simpanJadwal(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'laboratorium_id' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);
            
        JadwalPiket::create([
            'user_id' => $request->user_id,
            'laboratorium_id' => $request->laboratorium_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => 'Aktif']);

        return redirect('/admin/jadwal')
        ->with('success', 'Jadwal piket berhasil ditambahkan');
    }

    // EDIT JADWAL PIKET
    public function editJadwal($id)
    {
        $jadwal = JadwalPiket::findOrFail($id);
        $mahasiswa = User::where('role','mahasiswa')->get();
        $laboratorium = Laboratorium::all();
        
        return view('admin.edit_jadwal',compact('jadwal','mahasiswa','laboratorium'));
    }

    // UPDATE JADWAL PIKET
    public function updateJadwal(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'laboratorium_id' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);
        $jadwal = JadwalPiket::findOrFail($id);

        $jadwal->update([
            'user_id' => $request->user_id,
            'laboratorium_id' => $request->laboratorium_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);
        return redirect('/admin/jadwal')
        ->with('success', 'Jadwal berhasil diperbarui');
    }
    
    // HAPUS JADWAL PIKET
    public function hapusJadwal($id)
    {
        $jadwal = JadwalPiket::findOrFail($id);
        $jadwal->delete();

        return redirect('/admin/jadwal')
        ->with('success', 'Jadwal berhasil dihapus');
    }

    // MANAJEMEN TUKAR JADWAL PIKET
    public function tukar()
    {
        $pengajuan = TukarJadwal::with([
            'mahasiswa',
            'jadwalAwal.laboratorium',
            'jadwalPengganti.laboratorium'
        ])
        ->latest()
        ->get();

        return view(
            'admin.tukar',
            compact('pengajuan')
        );
    }

    // SETUJU TUKAR JADWAL
    public function setujuiTukar($id)
    {
        $tukar = TukarJadwal::findOrFail($id);

        if($tukar->status != 'Pending'){
            return back();
        }

        // ambil jadwal
        $jadwalAwal = JadwalPiket::find($tukar->jadwal_awal_id);
        $jadwalBaru = JadwalPiket::find($tukar->jadwal_pengganti_id);

        // kosongkan jadwal lama
        $jadwalAwal->update([
            'user_id' => null
        ]);

        // berikan jadwal baru
        $jadwalBaru->update([
            'user_id' => $tukar->user_id
        ]);

        // update status
        $tukar->update([
            'status' => 'Disetujui'
        ]);

        return back()->with(
            'success',
            'Pengajuan berhasil disetujui'
        );
}

    // TOLAK TUKAR JADWAL
    public function tolakTukar($id)
    {
        $tukar = TukarJadwal::findOrFail($id);

        $tukar->update([
            'status' => 'Ditolak'
        ]);

        return back()->with(
            'success',
            'Pengajuan berhasil ditolak'
        );
    }

    // MANAJEMEN MAHASISWA
    public function mahasiswa(Request $request)
    {
        $search = $request->search;
        $mahasiswa = User::where('role', 'mahasiswa')
        ->when($search, function($query) use ($search){
            $query->where(function($q) use ($search){
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('nim', 'like', "%{$search}%");
                });
        })
        ->get();
        return view('admin.mahasiswa', compact('mahasiswa'));
    }
    
    // TAMBAH MAHASISWA
    public function tambahMahasiswa()
    {
        return view('admin.tambah_mahasiswa');
    }

    // SIMPAN DATA MAHASISWA
    public function simpanMahasiswa(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'nim' => 'required|unique:users',
        'prodi' => 'required',
        'semester' => 'required',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'nim' => $request->nim,
        'prodi' => $request->prodi,
        'semester' => $request->semester,
        'role' => 'mahasiswa',

        // password otomatis = NIM
        'password' => bcrypt($request->nim)
    ]);

     return redirect('/admin/mahasiswa')
     ->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    // EDIT DATA MAHASISWA
    public function editMahasiswa($id)
    {
    $mahasiswa = User::findOrFail($id);

    return view('admin.edit_mahasiswa', compact('mahasiswa'));
    }

    // UPDATE DATA MAHASISWA
    public function updateMahasiswa(Request $request, $id)
    {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'nim' => 'required',
        'prodi' => 'required',
        'semester' => 'required'
    ]);

    $mahasiswa = User::findOrFail($id);

    $mahasiswa->update([
        'name' => $request->name,
        'email' => $request->email,
        'nim' => $request->nim,
        'prodi' => $request->prodi,
        'semester' => $request->semester,
    ]);

    return redirect('/admin/mahasiswa')
        ->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    // HAPUS DATA MAHASISWA
    public function hapusMahasiswa($id)
    {
    $mahasiswa = User::findOrFail($id);

    $mahasiswa->delete();

    return redirect('/admin/mahasiswa')
        ->with('success', 'Data mahasiswa berhasil dihapus');
    }

    // MANAJEMEN ABSENSI
    public function absensi(Request $request)
    {
        $search = $request->search;

        $absensi = Absensi::with([
            'mahasiswa',
            'jadwal.laboratorium'
        ])
        ->when($search, function ($query) use ($search) {

            $query->whereHas('mahasiswa', function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                ->orWhere('nim', 'like', "%{$search}%");

            });

        })
        ->latest()
        ->get();

        return view(
            'admin.absensi',
            compact('absensi')
        );
    }    

}