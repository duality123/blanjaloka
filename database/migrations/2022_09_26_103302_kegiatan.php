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
        Schema::create('kegiatan',function(Blueprint $table){
          $table->id();
          $table->string('tema',255);
          $table->text('deskripsi');
          $table->text('gambar')->nullable();
          $table->text('link')->nullable();
          $table->smallinteger('jumlah_orang_diundang')->default(0);
          $table->tinyInteger('masa_inkubasi',4)->nullable();
          $table->string('kurikulum',100)->nullable();
          $table->string('nama_juri',500)->nullable();
          $table->string('pic',255)->nullable();
          $table->string('kontak',200)->nullable();
          $table->boolean('draft')->default(0);
          $table->timestamp('dibuat')->default(now());
          $table->timestamp('dimulai')->default(now());
          $table->timestamp('berakhir')->default(now());
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        dropIfExists('kegiatan');
    }
};
