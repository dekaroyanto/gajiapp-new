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
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->date('tanggal');
            $table->integer('hadir');
            $table->integer('izin');
            $table->integer('sakit');
            $table->integer('terlambat');
            $table->integer('alpa');
            $table->bigInteger('gpokok')->default(0);
            $table->bigInteger('gjabatan')->default(0);
            $table->bigInteger('oprs')->default(0);
            $table->bigInteger('service')->default(0);
            $table->bigInteger('hp')->default(0);
            $table->bigInteger('insentif')->default(0);
            $table->bigInteger('angsuran')->default(0);
            $table->bigInteger('bpjs')->default(0);
            $table->bigInteger('kasbon')->default(0);
            $table->bigInteger('total_gaji')->nullable();
            $table->timestamps();

            $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gajis');
    }
};
