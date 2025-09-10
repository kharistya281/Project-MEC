<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Soal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'id_materi',
        'id_kuis',
        'pertanyaan',
        'gambar_pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'opsi_e',
        'jawaban_benar',
        'pembahasan'
    ];

    public function kuis():BelongsTo{
        return $this->belongsTo(Kuis::class, 'id_kuis');
    }

    public function materi():BelongsTo{
        return $this->belongsTo(Materi::class, 'id_materi');
    }

    public function jawaban():HasMany{
        return $this->hasMany(JawabanKuis::class, 'id_soal');
    }
}
