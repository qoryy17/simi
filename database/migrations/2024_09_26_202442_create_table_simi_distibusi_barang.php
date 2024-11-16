.<?php

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
            Schema::create('simi_distibusi_barang', function (Blueprint $table) {
                $table->id();
                $table->string('kode_distribusi');
                $table->string('nomor_bast')->nullable();
                $table->unsignedBigInteger('ruangan_id');
                $table->unsignedBigInteger('list_distribusi_id');
                $table->text('keterangan')->nullable();
                $table->enum('status', ['Pratinjau', 'Pengajuan', 'Selesai']);
                $table->unsignedBigInteger('verifikasi_id');
                $table->bigInteger('penerima');
                $table->bigInteger('diinput_oleh');
                $table->text('file_qrcode');
                $table->timestamps();

                $table->foreign('ruangan_id')->references('id')->on('simi_ruangan')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign('list_distribusi_id')->references('id')->on('simi_list_distribusi_barang')->onDelete('restrict')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('simi_distibusi_barang');
        }
    };
