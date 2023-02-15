<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{       
     public function up()
     {
       Schema::create('janji_temu', function (Blueprint $table) {
         $table->id();
         $table->foreignId('umkm_id')->references('id')->on('users')->onDelete('cascade');
         $table->foreignId('investor_id')->references('id')->on('users')->onDelete('cascade');
         $table->timestamp('waktu')->nullable();
         $table->string('lokasi',100)->nullable();
         $table->timestamp('berakhir')->nullable();
       });
     }

     public function down()
     {
         dropIfExists('janji_temu');
     }
};
