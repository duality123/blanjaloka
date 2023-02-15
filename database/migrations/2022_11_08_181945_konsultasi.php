<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{       
     public function up()
     {
       Schema::create('eventual', function (Blueprint $table) {
         $table->id();
         $table->foreignId('profil_id')->references('id')->on('profil')->onDelete('cascade');
         $table->foreignId('kegiatan_id')->references('id')->on('kegiatan')->onDelete('cascade');
         $table->string('perihal',100)->nullable();
         $table->tinyInteger('status',4)->nullable();
         $table->text('link_meeting')->nullable();
         $table->timestamp('waktu')->default(now());
         $table->timestamp('jadwal')->nullable();
         $table->varchar('kontak',255)->nullable();
         $table->string('nama_mentor',100)->nullable();

       });
     }

     public function down()
     {
         dropIfExists('eventual');
     }
};
