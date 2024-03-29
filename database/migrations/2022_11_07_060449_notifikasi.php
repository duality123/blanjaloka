<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{       
     public function up()
     {
       Schema::create('notifikasi', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->string('nama',50)->nullable();
         $table->text()->nullable();
         $table->timestamp('tanggal')->nullable();
         $table->tinyInteger('status')->nullable();
         $table->text('redirect')->nullable();
       });
     }

     public function down()
     {
         dropIfExists('notifikasi');
     }
};
