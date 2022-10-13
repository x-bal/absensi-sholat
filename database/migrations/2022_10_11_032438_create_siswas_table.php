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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('angkatan_id')->nullable()->constrained('angkatans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('jurusan_id')->nullable()->constrained('jurusans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('uid', 15)->unique();
            $table->string('nama_siswa')->nullable();
            $table->string('nipd')->nullable();
            $table->string('nisn')->nullable();
            $table->string('foto')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('siswas');
    }
};
