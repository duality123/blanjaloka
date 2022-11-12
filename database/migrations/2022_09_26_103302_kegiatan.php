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
          $table->char('tema',200);
          $table->text('deskripsi');
          $table->text('gambar')->nullable();
          $table->text('link')->nullable();
          $table->smallinteger('jumlah_orang_diundang')->default(0);
          $table->tinyInteger('masa_inkubasi');
          $table->char('kurikulum',100);
          $table->char('nama_juri',100);
          $table->char('pic',100);
          $table->char('kontak',200);
          $table->boolean('draft')->default(false);
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
