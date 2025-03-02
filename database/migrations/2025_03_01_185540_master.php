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
        Schema::create('fakultas', function (Blueprint $table) {
            $table->string('kode_fakultas')->primary();
            $table->string('nama_fakultas')->nullable();
            $table->timestamps();
        });
        Schema::create('prodi', function (Blueprint $table) {
            $table->string('kode_prodi')->primary();
            $table->string('nama_prodi')->nullable();
            $table->string('fakultas_id')->nullable();
            $table->foreign('fakultas_id')->references('kode_fakultas')->on('fakultas')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('kawe', function (Blueprint $table) {
            $table->string('kode_kawe')->primary();
            $table->string('nama_kawe')->nullable();
            $table->timestamps();
        });
        Schema::create('program_keterampilan_kawe', function (Blueprint $table) {
            $table->id();
            $table->string('kode_program')->nullable();
            $table->string('nama_program')->nullable();
            $table->string('kawe_id')->nullable();
            $table->foreign('kawe_id')->references('kode_kawe')->on('kawe')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('matakuliah', function (Blueprint $table) {
            $table->string('kode_matakuliah')->primary();
            $table->string('matakuliah')->nullable();
            $table->integer('sks')->nullable();
            $table->string('prodi_id')->nullable();
            $table->foreign('prodi_id')->references('kode_prodi')->on('prodi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matakuliah');
        Schema::dropIfExists('program_keterampilan_kawe');
        Schema::dropIfExists('kawe');
        Schema::dropIfExists('prodi');
        Schema::dropIfExists('fakultas');
    }
};
