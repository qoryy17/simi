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
        Schema::create('simi_verifikasi', function (Blueprint $table) {
            $table->id();
            $table->uuid('kode_verifikasi');
            $table->enum('status', ['Disetujui', 'Ditolak']);
            $table->text('keterangan');
            $table->integer('verifikator_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simi_verifikasi');
    }
};
