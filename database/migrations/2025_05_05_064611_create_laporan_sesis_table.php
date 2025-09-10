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
        Schema::create('laporan_sesis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jadwal')->constrained('jadwal_tutors')->cascadeOnDelete();
            $table->foreignId('id_tutor')->constrained('tutors')->cascadeOnDelete();
            $table->date('tgl_laporan');
            $table->string('materi_yg_dibahas');
            $table->string('kehadiran');
            $table->time('durasi_pertemuan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_sesis');
    }
};
