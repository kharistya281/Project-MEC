<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alamat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'id_siswa',
        'id_tutor',
        'provinsi_id',
        'provinsi_nama',
        'kabupaten_id',
        'kabupaten_nama',
        'kecamatan_id',
        'kecamatan_nama',
        'kelurahan_id',
        'kelurahan_nama',
        'alamat_detail',
    ];

    public function siswa():HasMany{
        return $this->hasMany(Siswa::class, 'id_alamat');
    }

    public function tutor():HasMany{
        return $this->hasMany(Tutor::class, 'id_alamat');
    }
}
