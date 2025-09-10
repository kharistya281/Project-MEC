<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Alamat;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $provinsiList = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json')->json();

        foreach ($provinsiList as $provinsi) {
            $regencies = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/{$provinsi['id']}.json")->json();
            foreach ($regencies as $kabupaten) {
                $districts = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/{$kabupaten['id']}.json")->json();
                foreach ($districts as $kecamatan) {
                    $villages = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/{$kecamatan['id']}.json")->json();
                    foreach ($villages as $kelurahan) {
                        Alamat::updateOrCreate(
                            ['kelurahan_id' => $kelurahan['id']],
                            [
                                'provinsi_id' => $provinsi['id'],
                                'provinsi_nama' => $provinsi['name'],
                                'kabupaten_id' => $kabupaten['id'],
                                'kabupaten_nama' => $kabupaten['name'],
                                'kecamatan_id' => $kecamatan['id'],
                                'kecamatan_nama' => $kecamatan['name'],
                                'kelurahan_id' => $kelurahan['id'],
                                'kelurahan_nama' => $kelurahan['name'],
                            ]
                        );
                    }
                }
            }
        }
    }
}
