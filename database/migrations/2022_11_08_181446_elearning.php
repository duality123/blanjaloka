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
        Schema::create('elearning',function(Blueprint $table){
        $table->id();
         $table->foreignId('kegiatan_id')->references('id')->on('kegiatan')->onDelete('cascade');
         $table->timestamp('hari_tanggal_waktu')->nullable();
         $table->char('judul',100)->nullable();
         $table->text('link_video')->nullable();
         $table->text('deskripsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        dropIfExists('elearning');
    }
};
