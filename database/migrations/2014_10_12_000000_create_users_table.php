<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // added by us
            $table->string('phone')->nullable();
            $table->date('birth_day')->nullable();
            $table->date('home_address')->nullable();
            $table->string('cv')->nullable()->nullable();
            $table->string('gender')->nullable();
            $table->string('qualification')->nullable();
            $table->string('avatar')->nullable();
            $table->string('adjective')->nullable();
            $table->string('nationality')->nullable();
            // for nutritionist to patients relation (1 to *)
            $table->unsignedBigInteger('nutritionist_id')->nullable();
            $table->foreign('nutritionist_id')->references('id')->on('users');
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
}
