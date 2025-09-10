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
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->foreignId('id_alamat')->constrained('alamats')->cascadeOnDelete();
            $table->string('nama_tutor');
            $table->string('alamat_tutor');
            $table->string('notelp_tutor');
            $table->string('kesibukan_tutor');
            $table->string('foto_tutor');
            // $table->string('email_tutor');
            // $table->string('password_tutor');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};
