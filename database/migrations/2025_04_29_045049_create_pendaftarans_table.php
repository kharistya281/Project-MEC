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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->constrained('siswas')->cascadeOnDelete();
            $table->foreignId('id_program')->constrained('programs')->cascadeOnDelete();
            $table->string('id_order')->unique();
            $table->date('tanggal_daftar');
            $table->integer('total');
            $table->enum('status_pembayaran', ['Pending', 'Paid', 'Failed'])->default('Pending');
            $table->string('snapToken');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
