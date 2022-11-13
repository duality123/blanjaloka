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
         $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->timestamp('hari_tanggal_waktu')->nullable();
         $table->char('perihal',100)->nullable();
         $table->text('pesan')->nullable();
       });
     }

     public function down()
     {
         dropIfExists('janji_temu');
     }
};
