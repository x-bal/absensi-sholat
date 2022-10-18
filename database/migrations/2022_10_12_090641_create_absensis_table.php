<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained('devices')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('jadwal_id')->constrained('jadwals')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal');
            $table->enum('keterangan', ['Hadir', 'Telat', 'Tidak Hadir']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensis');
    }
};
