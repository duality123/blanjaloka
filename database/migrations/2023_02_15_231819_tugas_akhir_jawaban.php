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
        Schema::create('tugas_akhir_jawaban', function (Blueprint $table) {
         $table->id();
         $table->text('jawaban')->nullable();
         $table->text('gambar')->nullable();
         $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->foreignId('kegiatan_id')->references('id')->on('kegiatan')->onDelete('cascade');
         $table->text('file')->nullable();
         $table->timestamp('tanggal')->nullable();
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        dropIfExists('tugas_akhir_jawaban');
    }
};
