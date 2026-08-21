<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TukarJadwal extends Model
{
    protected $table = 'tukar_jadwal';

    protected $fillable = [
        'user_id',
        'jadwal_awal_id',
        'jadwal_pengganti_id',
        'alasan',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function jadwalAwal()
    {
        return $this->belongsTo(
            JadwalPiket::class,
            'jadwal_awal_id'
        );
    }

    public function jadwalPengganti()
    {
        return $this->belongsTo(
            JadwalPiket::class,
            'jadwal_pengganti_id'
        );
    }
}