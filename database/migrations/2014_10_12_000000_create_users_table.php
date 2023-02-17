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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable();
            $table->string('email',255)->unique();
            $table->string('no_telepon',14)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('password',100)->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider_token')->nullable();
            $table->tinyInteger('role',4)->nullable();
            $table->boolean('accepted')->nullable();
            $table->smallInteger('notifikasi')->default(0);
            $table->smallInteger('notif_pesan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
