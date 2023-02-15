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
         Schema::create('dokumen_perusahaan', function (Blueprint $table) {
         $table->id();
         $table->text('foto_buku_tabungan')->nullable();
         $table->text('foto_npwp_perusahaan')->nullable();
         $table->text('foto_ktp_pic')->nullable();
         $table->string('no_akta_pendirian_perusahaan',100)->nullable();
         $table->string('no_npwp_perusahaan',100)->nullable();
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
        dropIfExists('dokumen_perusahaan');
    }
};
