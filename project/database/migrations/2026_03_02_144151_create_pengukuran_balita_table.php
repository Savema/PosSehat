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
        Schema::create('pengukuran_balita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('balita_id')
                ->constrained('balita')
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->decimal('berat_badan', 5, 2);      // kg
            $table->decimal('tinggi_badan', 5, 2);     // cm
            $table->decimal('lingkar_kepala', 5, 2);   // cm

            $table->integer('usia_saat_ukur');         // bulan
            $table->date('tanggal');

            $table->string('hasil');
            $table->decimal('zs_tbu', 5, 2)->nullable();
            $table->decimal('bmi', 5, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengukuran_balita');
    }
};
