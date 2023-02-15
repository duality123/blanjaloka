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
    Schema::create('bisnis_peserta', function (Blueprint $table) {
        $table->id();
        $table->bigInteger('umkm_id')->unsigned();
        $table->bigInteger('bisnis_id')->unsigned();
        $table->foreignId('umkm_foreign')->references('id')->on('users')->onDelete('cascade');
        $table->foreignId('bisnis_foreign')->references('id')->on('users')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        dropIfExists('bisnis_peserta');
    }
};
