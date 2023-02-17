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
         Schema::create('info_admin', function (Blueprint $table) {
         $table->id();
         $table->text('isi')->nullable();
         $table->boolean('tandai')->default(0);
         $table->timestamp('tanggal')->nullable();
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        dropIfExists('info_admin');
    }
};
