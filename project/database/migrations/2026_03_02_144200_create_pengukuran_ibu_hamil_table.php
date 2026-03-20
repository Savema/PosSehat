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
        Schema::create('pengukuran_ibu_hamil', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ibu_hamil_id')
                ->constrained('ibu_hamil')
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->decimal('berat_badan', 5, 2);   // kg
            $table->decimal('tinggi_badan', 5, 2);  // cm
            $table->decimal('lila', 5, 2)->nullable(); // cm

            $table->integer('usia_kehamilan'); // minggu
            $table->date('tanggal');

            $table->decimal('imt', 5, 2);

            $table->enum('status_gizi', [
                'ibu hamil gizi kurang',
                'ibu hamil gizi normal',
                'ibu hamil gizi lebih',
                'ibu hamil obesitas'
            ])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengukuran_ibu_hamil');
    }
};
