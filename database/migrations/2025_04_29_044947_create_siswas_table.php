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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->foreignId('id_alamat')->constrained('alamats')->cascadeOnDelete();
            $table->foreignId('id_program')->constrained('programs')->cascadeOnDelete();
            $table->string('nama_siswa');
            $table->string('asal_sekolah');
            $table->string('alamat_siswa');
            $table->string('notelp_siswa');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
