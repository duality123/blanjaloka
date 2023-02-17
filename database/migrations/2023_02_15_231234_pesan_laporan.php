<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
     {
       Schema::create('laporan', function (Blueprint $table) {
         $table->id();
         $table->text('isi')->nullable();
         $table->text('email')->nullable();
         $table->boolean('tandai')->default(0);
         $table->text('gambar')->nullable();
         $table->timestamp('tanggal')->nullable();
       });
     }

     public function down()
     {
         dropIfExists('laporan');
     }

};
