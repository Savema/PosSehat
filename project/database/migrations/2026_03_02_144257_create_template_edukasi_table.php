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
        Schema::create('template_edukasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100);
            $table->text('konten');
            $table->enum('kategori', [
                'Sangat Pendek',
                'Pendek',
                'Normal',
                'Ibu hamil gizi kurang',
                'Ibu hamil gizi normal',
                'Ibu hamil gizi lebih',
                'Ibu hamil obesitas',
            ])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_edukasi');
    }
};
