<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{       
     public function up()
     {
       Schema::create('konsultasi', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->foreignId('mentor_id')->references('id')->on('users')->onDelete('cascade');
         $table->char('perihal',100)->nullable();
         $table->text('pesan')->nullable();
         $table->text('link')->nullable();
         $table->timestamp('jadwal')->nullable();

       });
     }

     public function down()
     {
         dropIfExists('konsultasi');
     }
};
