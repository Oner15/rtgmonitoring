<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->string('unit_code');
            $table->string('block');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('priority', ['rendah', 'sedang', 'tinggi', 'kritis'])->default('sedang');
            $table->enum('status', ['laporan_baru', 'sedang_dikerjakan', 'menunggu_suku_cadang', 'selesai'])->default('laporan_baru');
            $table->unsignedBigInteger('teknisi_id')->nullable();
            $table->string('teknisi_nama')->nullable();
            $table->integer('eta_minutes')->nullable();
            $table->integer('mttr_minutes')->nullable();
            $table->string('part_needed')->nullable();
            $table->string('reported_by')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('teknisi_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
