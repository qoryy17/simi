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
        Schema::create('simi_list_peminjaman_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman');
            $table->unsignedBigInteger('peminjaman_barang_id');
            $table->char('barang_id');
            $table->string('kode_barang');
            $table->timestamps();

            $table->foreign('peminjaman_barang_id')->references('id')->on('simi_peminjaman_barang')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('barang_id')->references('id')->on('simi_barang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simi_list_peminjaman_barang');
    }
};
