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
         Schema::create('profil_perusahaan', function (Blueprint $table) {
         $table->id();
         $table->text('alamat_perusahaan')->nullable();
         $table->string('nama_perusahaan',255)->nullable();
         $table->timestamp('tanggal_berdiri')->nullable();
         $table->string('no_telepon',14)->nullable();
         $table->string('email_pic',255)->nullable();
         $table->string('kategori_perusahaan',255)->nullable();
         $table->text('deskripsi_perusahaan')->nullable();
         $table->string('nama_pic',255)->nullable();
         $table->string('no_rekening',100)->nullable();
         $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        dropIfExists('profil_perusahaan');
    }
};
