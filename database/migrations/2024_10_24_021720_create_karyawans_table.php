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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karyawan');
            $table->string('nama_jabatan');
            $table->string('jabatan');
            $table->string('kode_jabatan');
            $table->bigInteger('nik')->unique();
            $table->bigInteger('norek')->unique();
            $table->bigInteger('no_telp')->unique();
            $table->date('tgl_masuk');
            $table->float('lama_kerja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
