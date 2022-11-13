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
<<<<<<< HEAD
            $table->char('name',50)->nullable();
            $table->char('email',100)->unique();
            $table->char('no_telepon',14)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->char('password',100)->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider_token')->nullable();
            $table->tinyInteger('role')->nullable();
            $table->boolean('accepted')->nullable();
            $table->smallInteger('notifikasi')->default(0);
=======
            $table->string('name');
            $table->string('email')->unique();
            $table->string('no_telepon')->unique()->nullable();;
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('provider_id')->nullable();
            $table->string('provider_token')->nullable();
>>>>>>> 4d26dc5c2536a724370326f1054053f22d834f13
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
