<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('profil', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->text('foto_profil')->nullable();
         $table->string('nama_lengkap',255)->nullable();
         $table->timestamp('tanggal_lahir')->nullable();
         $table->string('pendidikan_terakhir',20)->nullable();
         $table->string('tempat_kelahiran',50)->nullable();
         $table->text('alamat')->nullable();
         $table->string('kelurahan',50)->nullable();
         $table->string('kecamatan',50)->nullable();
         $table->string('kabupaten',50)->nullable();
         $table->string('provinsi',50)->nullable();
         $table->text('foto_ktp')->nullable();
         $table->text('foto_dengan_ktp')->nullable();
         $table->string('no_hp',14)->nullable();
         $table->string('status',30)->nullable();
         $table->string('kewarganegaraan',20)->nullable();
         $table->string('agama',10)->nullable();
         $table->text('pengalaman_kerja')->nullable();
       });
     }


     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         dropIfExists('profil');
     }
};
