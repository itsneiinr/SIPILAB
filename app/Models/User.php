<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\JadwalPiket;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nim',
        'prodi',
        'semester',
        'foto_profil'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'timestamp',
        'password' => 'hashed',
    ];

    public function jadwalPiket()
    {
        return $this->hasMany(JadwalPiket::class, 'user_id');
    }

    public function tukarJadwal()
    {
        return $this->hasMany(TukarJadwal::class,'user_id');
    }
}
