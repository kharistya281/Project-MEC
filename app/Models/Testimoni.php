<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimoni extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_siswa',
        'is_accepted',
        'diterima_di',
        'pesan_kesan'
    ];

    public function siswa():BelongsTo{
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
