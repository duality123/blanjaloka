<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
     {
       Schema::create('pesan_laporan', function (Blueprint $table) {
         $table->id();
         $table->text('isi')->nullable();
         $table->text('gambar')->nullable();
         $table->timestamp('tanggal')->nullable();
       });
     }

     public function down()
     {
         dropIfExists('pesan_laporan');
     }

};
