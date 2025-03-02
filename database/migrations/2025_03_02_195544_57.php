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
        Schema::create('57_mahasiswa', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama')->nullable();
            $table->string('prodi_id')->nullable();
            $table->foreign('prodi_id')->references('kode_prodi')->on('prodi')->onDelete('cascade');
            $table->string('status_lulus')->nullable();
            $table->string('no_ijasah')->nullable();
            $table->string('no_ijasah_nasional')->nullable();
            $table->string('ipk')->nullable();
            $table->string('smt_lulus')->nullable();
            $table->string('smt_masuk')->nullable();
            $table->timestamps();
        });
        Schema::create('57_riwayat_kawe', function (Blueprint $table) {
            $table->id();
            $table->string('nim_id')->nullable();
            $table->foreign('nim_id')->references('nim')->on('57_mahasiswa')->onDelete('cascade');
            $table->string('kawe_id')->nullable();
            $table->foreign('kawe_id')->references('kode_kawe')->on('kawe')->onDelete('cascade');
            $table->string('nilai')->nullable();
            $table->string('tahun_akademik')->nullable();
            $table->timestamps();
        });
        Schema::create('57_riwayat_matakuliah', function (Blueprint $table) {
            $table->id();
            $table->string('nim_id')->nullable();
            $table->foreign('nim_id')->references('nim')->on('57_mahasiswa')->onDelete('cascade');
            $table->string('matakuliah_id')->nullable();
            $table->foreign('matakuliah_id')->references('kode_matakuliah')->on('matakuliah')->onDelete('cascade');
            $table->string('semester')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
