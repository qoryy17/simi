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
        Schema::create('simi_histori_barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id');
            $table->string('kode_barang');
            $table->unsignedBigInteger('ruangan_id');
            $table->timestamps();

            $table->foreign('ruangan_id')->references('id')->on('simi_ruangan')->onDelete('cascade');
            $table->foreign('barang_id')->references('id')->on('simi_barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simi_histori_barang');
    }
};
