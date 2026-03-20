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
        Schema::table('pengukuran_balita', function (Blueprint $table) {
            $table->dropColumn([
                'bmi',
                'zs_bmi_u',
                'status_gizi_bmi'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        {
        Schema::table('pengukuran_balita', function (Blueprint $table) {
            $table->decimal('bmi', 5, 2)->nullable();
            $table->decimal('zs_bmi_u', 5, 2)->nullable();
            $table->string('status_gizi_bmi', 100)->nullable();
        });
    }
    }
};
