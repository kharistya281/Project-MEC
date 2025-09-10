<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kuis extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'id_materi',
        'judul_kuis'
    ];

    public function materi():BelongsTo{
        return $this->belongsTo(Materi::class, 'id_materi');
    }

    public function soal():HasMany{
        return $this->hasMany(Soal::class, 'id_kuis');
    }

    public function jawaban():HasMany{
        return $this->hasMany(JawabanKuis::class, 'id_kuis');
    }
}
