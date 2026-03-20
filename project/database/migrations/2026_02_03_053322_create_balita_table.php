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
        Schema::create('balita', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama', 100);
            $table->tinyInteger('jenis_kelamin'); // 1 = laki-laki, 0 = perempuan
            $table->date('tgl_lahir');
            $table->string('nama_ortu', 50);
            $table->text('alamat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anak');
    }
};
