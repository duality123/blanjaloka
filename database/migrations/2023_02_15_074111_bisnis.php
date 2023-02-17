<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up()
     {
       Schema::create('bisnis', function (Blueprint $table) {
         $table->id();
         $table->string('name',255)->nullable();
         $table->text('foto_bisnis')->nullable();
         $table->bigInteger('jumlah_investasi')->unsigned()->default(0);
         $table->bigInteger('target_investasi')->unsigned()->default(0);
         $table->mediumInteger('jumlah_investor')->default(0);
         $table->float('persentase_hasil_investasi')->default(0);
         $table->timestamp('waktu_balik_modal_start')->nullable();
         $table->timestamp('waktu_balik_modal_end')->nullable();
         $table->bigInteger('minimum_investasi')->unsigned()->default(0);
         $table->bigInteger('total_penghasilan')->unsigned()->default(0);
         $table->string('kategori',50)->nullable();
         $table->text('lokasi')->nullable();
         $table->tinyInteger('status',1)->default(0);
         $table->bigInteger('total_penghasilan')->unsigned()->default(0);

       });
     }

     public function down()
     {
         dropIfExists('bisnis');
     }
};
