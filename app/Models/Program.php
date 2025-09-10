<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'nama_program',
        'desc_program',
        'biaya_program',
        'tgl_mulai',
        'tgl_akhir',
        'is_active'
    ];

    public function jadwal():HasMany{
        return $this->hasMany(JadwalTutor::class, 'id_program');
    }

    public function materi():HasMany{
        return $this->hasMany(Materi::class, 'id_program');
    }

    public function siswa():HasMany{
        return $this->hasMany(Siswa::class, 'id_program');
    }

    public function pendaftaran():HasMany{
        return $this->hasMany(Pendaftaran::class, 'id_program');
    }

    public function isDone(){
        return (!is_null($this->tgl_akhir) && Carbon::now()->gt($this->tgl_akhir)) || $this->is_active ==0;
    }
}
