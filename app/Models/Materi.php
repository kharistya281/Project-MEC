<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_program',
        'nama_materi'
    ];

    // public function tutor():BelongsTo{
    //     return $this->belongsTo(Tutor::class,'id_tutor');
    // }

    public function program():BelongsTo{
        return $this->belongsTo(Program::class,'id_program');
    }

    public function jadwal():HasMany{
        return $this->hasMany(JadwalTutor::class, 'id_materi');
    }

    public function kuis():HasMany{
        return $this->hasMany(Kuis::class, 'id_materi');
    }

    public function soal():HasMany{
        return $this->hasMany(Soal::class, 'id_materi');
    }
}
