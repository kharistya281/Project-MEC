<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sesi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'jam_mulai',
        'jam_selesai',
        'keterangan'
    ];

    public function jadwal():HasMany{
        return $this->hasMany(JadwalTutor::class, 'id_sesi');
    }
}
