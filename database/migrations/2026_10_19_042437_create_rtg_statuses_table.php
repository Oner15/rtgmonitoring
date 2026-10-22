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
    Schema::create('rtg_statuses', function (Blueprint $table) {
        $table->id();
        $table->string('unit_code'); // Menyimpan nomor unit, contoh: RTG 38[cite: 1]
        $table->string('block');     // Menyimpan blok area, contoh: A, B, C[cite: 1]
        $table->enum('status', ['ready', 'perbaikan']); // Status unit[cite: 1]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rtg_statuses');
    }
};
