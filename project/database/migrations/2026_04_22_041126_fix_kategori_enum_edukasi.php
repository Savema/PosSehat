<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE edukasi MODIFY kategori ENUM(
            'Sangat Pendek',
            'Pendek',
            'Normal',
            'Ibu hamil gizi kurang',
            'Ibu hamil gizi normal',
            'Ibu hamil gizi lebih',
            'Ibu hamil obesitas'
        ) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
