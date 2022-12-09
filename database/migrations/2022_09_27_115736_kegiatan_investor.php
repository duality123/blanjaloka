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
      Schema::create('kegiatan_investor', function (Blueprint $table) {
        $table->id();
        $table->Integer('investor_id')->unsigned();
        $table->Integer('kegiatan_id')->unsigned();
        $table->foreignId('investor_foreign')->references('id')->on('users')->onDelete('cascade');

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        dropIfExists('kegiatan_investor');
    }
};
