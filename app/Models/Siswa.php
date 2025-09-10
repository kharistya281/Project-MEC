<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'id_user',
        'id_alamat',
        'id_program',
        'nama_siswa',
        'asal_sekolah',
        'notelp_siswa'
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class,'id_user');
    }

    public function program():BelongsTo{
        return $this->belongsTo(Program::class,'id_program');
    }

    public function pendaftaran():HasMany{
        return $this->hasMany(Pendaftaran::class,'id_siswa');
    }

    public function alamat():BelongsTo{
        return $this->belongsTo(Alamat::class, 'id_alamat');
    }

    public function jawaban():HasMany{
        return $this->hasMany(JawabanKuis::class, 'id_siswa');
    }

    public function testimoni():HasMany{
        return $this->hasMany(Testimoni::class, 'id_siswa');
    }
}
