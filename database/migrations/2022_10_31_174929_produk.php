<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{       
     public function up()
     {
       Schema::create('produk', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->char('jenis_produk',50)->nullable();
         $table->smallInteger('jumlah_produk_yang_dijual')->nullable();
         $table->char('bahan_produk',100)->nullable();
         $table->char('kategori_produk',50)->nullable();
         $table->bigInteger('harga_produk')->nullable();
         $table->text('keterangan_halal')->nullable();
         $table->text('manfaat_fungsional')->nullable();
         $table->text('manfaat_nonfungsional')->nullable();
       });
     }

     public function down()
     {
         dropIfExists('produk');
     }
};
