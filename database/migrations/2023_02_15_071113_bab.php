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

       Schema::create('bab', function (Blueprint $table) {
         $table->id();
         $table->foreignId('elearning_id')->references('id')->on('elearning')->onDelete('cascade');
         $table->text('deskripsi')->nullable();
         $table->string('judul',255)->nullable();
         $table->text('link_video')->nullable();
         $table->smallInteger('bab',6)->nullable();
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        dropIfExists('bab');
    }
};
