<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{       
     public function up()
     {
       Schema::create('logbook', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->foreignId('kegiatan_id')->references('id')->on('users')->onDelete('cascade');
         $table->timestamp('hari_tanggal_bulan')->nullable();
         $table->text('link')->nullable();
         $table->text('deskripsi')->nullable();
         $table->text('bukti_kegiatan')->nullable();
         $table->tinyInteger('status',4)->nullable();
         $table->timestamp('waktu')->default(now());


       });
     }

     public function down()
     {
         dropIfExists('logbook');
     }
};
