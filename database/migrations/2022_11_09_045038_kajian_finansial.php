<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{       
     public function up()
     {
       Schema::create('kajian_finansial', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
         $table->text('capex')->nullable();
         $table->text('opex')->nullable();
         $table->text('swot_faktor_internal')->nullable();
         $table->text('swot_faktor_eksternal')->nullable();
         $table->tinyInteger('payback_period')->nullable();
         $table->string('key_partners',1000)->nullable();
         $table->text('key_activity')->nullable();
         $table->string('value_propotions',100)->nullable();
         $table->string('customer_relationship',255)->nullable();
         $table->string('channels',500)->nullable();
         $table->string('cost_structure',100)->nullable();
         $table->string('revenue_streams',100)->nullable();
       });
     }

     public function down()
     {
         dropIfExists('kajian_finansial');
     }
};
