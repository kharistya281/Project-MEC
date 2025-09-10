<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendaftaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_siswa',
        'id_program',
        'id_order',
        'tanggal_daftar',
        'total',
        'status_pembayaran',
        'snapToken',
    ];

    public function siswa():BelongsTo{
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function program():BelongsTo{
        return $this->belongsTo(Program::class, 'id_program');
    }
}
