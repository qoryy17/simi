<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('simi_barang', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string('kode_barang');
            $table->text('nama_barang');
            $table->string('jenis');
            $table->string('merek');
            $table->string('tipe');
            $table->string('nomor_seri');
            $table->string('ukuran');
            $table->string('bahan');
            $table->integer('jumlah');
            $table->unsignedBigInteger('satuan_barang_id')->nullable();
            $table->integer('harga');
            $table->string('sumber_dana');
            $table->unsignedBigInteger('kondisi_barang_id')->nullable();
            $table->string('tahun_pengadaan');
            $table->string('nomor_kontrak');
            $table->date('tanggal_kontrak');
            $table->text('file_edoc');
            $table->enum('status', ['Pratinjau', 'Pengajuan', 'Selesai']);
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('diinput_oleh');
            $table->unsignedBigInteger('verifikasi_id')->nullable();
            $table->text('file_image')->nullable();
            $table->timestamps();

            $table->foreign('satuan_barang_id')->references('id')->on('simi_satuan_barang')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('kondisi_barang_id')->references('id')->on('simi_kondisi_barang')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('verifikasi_id')->references('id')->on('simi_verifikasi')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simi_barang');
    }
};
