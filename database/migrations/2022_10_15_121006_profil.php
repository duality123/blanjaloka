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
         $table->char('nama_lengkap',200)->nullable();
         $table->timestamp('tanggal_lahir')->nullable();
         $table->char('pendidikan_terakhir',20)->nullable();
         $table->char('tempat_kelahiran',50)->nullable();
         $table->char('alamat',200)->nullable();
         $table->char('kelurahan',50)->nullable();
         $table->char('kecamatan',50)->nullable();
         $table->char('kabupaten',50)->nullable();
         $table->char('provinsi',50)->nullable();
         $table->text('foto_ktp')->nullable();
         $table->text('foto_dengan_ktp')->nullable();
         $table->char('no_hp',14)->nullable();
         $table->char('status',30)->nullable();
         $table->char('kewarganegaraan',20)->nullable();
         $table->char('agama',10)->nullable();
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
