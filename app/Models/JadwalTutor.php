<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalTutor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'id_ruang',
        'id_kelas',
        'id_program',
        'id_tutor',
        'id_sesi',
        'id_materi',
        'id_laporan',
        'hari'
    ];

    public function ruang():BelongsTo{
        return $this->belongsTo(Ruang::class, 'id_ruang');
    }

    public function kelas():BelongsTo{
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function sesi():BelongsTo{
        return $this->belongsTo(Sesi::class, 'id_sesi');
    }

    public function program():BelongsTo{
        return $this->belongsTo(Program::class, 'id_program');
    }

    public function tutor():BelongsTo{
        return $this->belongsTo(Tutor::class, 'id_tutor');
    }

    public function laporanSesi():HasOne{
        return $this->hasOne(LaporanSesi::class, 'id_jadwal');
    }

    public function materi():BelongsTo{
        return $this->belongsTo(Materi::class, 'id_materi');
    }
}
