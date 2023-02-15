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
         Schema::create('investasi', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->foreignId('bisnis_id')->references('id')->on('bisnis')->onDelete('cascade');
         $table->text('bukti')->nullable();
         $table->bigInteger('investasi_masuk')->unsigned();
         $table->bigInteger('investasi_keluar')->unsigned();
          });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        dropIfExists('investasi');
    }
};
