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
        $table->string('unit_code')->unique();
        $table->string('block')->nullable();
        $table->string('status')->default('ready');
        $table->string('pelapor')->nullable();
        $table->text('pra_ops')->nullable();
        $table->text('pasca_ops')->nullable();
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
