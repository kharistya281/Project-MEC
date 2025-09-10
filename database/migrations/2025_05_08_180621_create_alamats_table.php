<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alamats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->constrained('siswas')->cascadeOnDelete();
            $table->foreignId('id_tutor')->constrained('tutors')->cascadeOnDelete();
            $table->unsignedBigInteger('provinsi_id');
            $table->string('provinsi_nama');
            $table->unsignedBigInteger('kabupaten_id');
            $table->string('kabupaten_nama');
            $table->unsignedBigInteger('kecamatan_id');
            $table->string('kecamatan_nama');
            $table->unsignedBigInteger('kelurahan_id');
            $table->string('kelurahan_nama');
            $table->string('alamat_detail');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamats');
    }
};
