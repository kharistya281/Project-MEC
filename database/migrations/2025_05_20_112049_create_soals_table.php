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
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_materi')->constrained('materis')->cascadeOnDelete();
            $table->foreignId('id_kuis')->constrained('kuis')->cascadeOnDelete();
            $table->text('pertanyaan');
            $table->string('gambar_pertanyaan');
            $table->string('opsi_a');
            $table->string('opsi_b');
            $table->string('opsi_c');
            $table->string('opsi_d');
            $table->string('opsi_e');
            $table->enum('jawaban_benar', ['A', 'B', 'C', 'D']);
            $table->text('pembahasan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
