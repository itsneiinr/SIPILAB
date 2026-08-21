<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPiket extends Model
{
    protected $table = 'jadwal_piket';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'laboratorium_id',
        'hari',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class, 'laboratorium_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'jadwal_piket_id');
    }
}