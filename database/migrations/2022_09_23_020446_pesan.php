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
      Schema::create('pesan', function (Blueprint $table) {
          $table->id();
          $table->foreignId('pengirim')->references('id')->on('users')->onDelete('restrict');
          $table->text('isi');
          $table->timestamp('update')->nullable();
          $table->timestamp('tanggal_kirim')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        dropIfExists('pesan');
    }
};
