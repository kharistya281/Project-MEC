<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class JawabanKuis extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'id_siswa',
        'id_kuis',
        'id_soal',
        'jawaban_siswa',
        'jawaban_benar',
        'is_benar'
    ];

    public function siswa():BelongsTo{
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function kuis():BelongsTo{
        return $this->belongsTo(Kuis::class, 'id_kuis');
    }

    public function soal():BelongsTo{
        return $this->belongsTo(Soal::class, 'id_soal');
    }
}
