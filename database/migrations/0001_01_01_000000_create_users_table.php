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
        // Create table simi_jabatan
        Schema::create('simi_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan');
            $table->string('kode_jabatan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Create table simi_pegawai
        Schema::create('simi_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('nama');
            $table->unsignedBigInteger('jabatan_id')->nullable();
            $table->enum('status', ['Aktif', 'Non Aktif'])->default('Aktif');
            $table->timestamps();

            $table->foreign('jabatan_id')->references('id')->on('simi_jabatan')->onDelete('set null')->onUpdate('cascade');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('pegawai_id')->nullable();
            $table->enum('role', ['Superadmin', 'Operator', 'Verifikator']);
            $table->enum('blokir', ['Y', 'T'])->default('Y');
            $table->timestamps();

            $table->foreign('pegawai_id')->references('id')->on('simi_pegawai')->onDelete('set null')->onUpdate('cascade');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('simi_pegawai');
        Schema::dropIfExists('simi_jabatan');
    }
};
