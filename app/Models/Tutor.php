<?php

namespace App\Models;

use Filament\Panel\Concerns\HasFont;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'id_user',
        'id_alamat',
        'nama_tutor',
        'alamat_tutor',
        'notelp_tutor',
        'kesibukan_tutor',
        'foto_tutor',
        
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class,'id_user');
    }

    public function jadwal():HasMany{
        return $this->hasMany(JadwalTutor::class,'id_tutor');
    }

    // public function materi():HasMany{
    //     return $this->hasMany(Materi::class,'id_tutor');
    // }

    public function laporanSesi():HasMany{
        return $this->hasMany(LaporanSesi::class, 'id_tutor');
    }

    public function alamat():BelongsTo{
        return $this->belongsTo(Alamat::class, 'id_alamat');
    }
}
