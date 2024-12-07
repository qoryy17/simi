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
        Schema::create('simi_institusi', function (Blueprint $table) {
            $table->id();
            $table->string('cabdis_provinsi', 300);
            $table->string('cabdis_kabupaten', 300);
            $table->string('npsn');
            $table->string('nama_sekolah');
            $table->text('alamat');
            $table->string('email');
            $table->string('telepon');
            $table->string('website');
            $table->text('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simi_institusi');
    }
};
