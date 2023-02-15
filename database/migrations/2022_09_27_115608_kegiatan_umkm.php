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
      Schema::create('kegiatan_umkm', function (Blueprint $table) {
        $table->id();
        $table->bigInteger('umkm_id')->unsigned();
        $table->bigInteger('kegiatan_id')->unsigned();
        $table->boolean('lulus_funding')->default(0);
        $table->foreignId('investor_foreign')->references('id')->on('users')->onDelete('cascade');
        $table->foreignId('kegiatan_foreign')->references('id')->on('users')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        dropIfExists('kegiatan_umkm');
    }
};
