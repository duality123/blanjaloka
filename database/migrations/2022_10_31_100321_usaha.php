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
         $table->char('nama_perusahaan',100)->nullable();
         $table->char('alamat_perusahaan',100)->nullable();
         $table->char('status_perusahaan',50)->nullable();
         $table->text('legalitas')->nullable();
         $table->text('dokumen_amdal',)->nullable();
         $table->char('informasi_pajak',100)->nullable();
         $table->char('npwp',100)->nullable();
         $table->text('deskripsi_usaha')->nullable();
         $table->char('email_perusahaan',100)->nullable();
       });
     }

     public function down()
     {
         dropIfExists('usaha');
     }
};
