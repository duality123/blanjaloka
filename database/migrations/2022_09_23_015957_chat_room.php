<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
<<<<<<< HEAD
use Illuminate\Support\Str;
=======
>>>>>>> 4d26dc5c2536a724370326f1054053f22d834f13

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
      Schema::create('chat_room', function (Blueprint $table) {
          $table->id();
          $table->timestamp('update')->nullable();
          $table->string('link')->default(Str::random(100));
          
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
        dropIfExists('chat_room');
=======
        //
>>>>>>> 4d26dc5c2536a724370326f1054053f22d834f13
    }
};
