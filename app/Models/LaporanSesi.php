<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanSesi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_jadwal',
        'id_tutor',
        'tgl_laporan',
        'materi_yg_dibahas',
        'progres_siswa',
        'kehadiran',
        'durasi_pertemuan'
    ];

    public function tutor():BelongsTo{
        return $this->belongsTo(Tutor::class, 'id_tutor');
    }

    public function jadwal():BelongsTo{
        return $this->belongsTo(JadwalTutor::class, 'id_jadwal');
    }
}
