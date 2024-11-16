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
        Schema::create('simi_peminjaman_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman');
            $table->unsignedBigInteger('list_peminjaman_id')->nullable();
            $table->integer('durasi')->comment('hitungan hari');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian');
            $table->unsignedBigInteger('ruangan_id');
            $table->unsignedBigInteger('pegawai_id');
            $table->enum('status', ['Peminjaman', 'Selesai']);
            $table->text('keterangan')->nullable();
            $table->text('file_qrcode');
            $table->bigInteger('diinput_oleh');
            $table->timestamps();

            $table->foreign('list_peminjaman_id')->references('id')->on('simi_list_peminjaman_barang')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('ruangan_id')->references('id')->on('simi_ruangan')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('pegawai_id')->references('id')->on('simi_pegawai')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simi_peminjaman_barang');
    }
};
