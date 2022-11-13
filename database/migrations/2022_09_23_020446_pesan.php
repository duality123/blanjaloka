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
<<<<<<< HEAD
      Schema::create('pesan', function (Blueprint $table) {
          $table->id();
          $table->foreignId('pengirim')->references('id')->on('users')->onDelete('restrict');
          $table->text('isi');
          $table->timestamp('update')->nullable();
          $table->timestamp('tanggal_kirim')->nullable();
      });
=======
        //
>>>>>>> 4d26dc5c2536a724370326f1054053f22d834f13
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD
        dropIfExists('pesan');
=======
        //
>>>>>>> 4d26dc5c2536a724370326f1054053f22d834f13
    }
};
