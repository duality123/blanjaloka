<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{       
     public function up()
     {
       Schema::create('usaha', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->string('nama_perusahaan',255)->nullable();
         $table->text('alamat_perusahaan')->nullable();
         $table->string('status_perusahaan',50)->nullable();
         $table->text('legalitas')->nullable();
         $table->text('dokumen_amdal',)->nullable();
         $table->string('informasi_pajak',100)->nullable();
         $table->string('npwp',100)->nullable();
         $table->text('deskripsi_usaha')->nullable();
         $table->string('email_perusahaan',255)->nullable();
       });
     }

     public function down()
     {
         dropIfExists('usaha');
     }
};
