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
            $table->string('phone');
            $table->date('birth_day');
            $table->date('home_address');
            $table->string('cv')->nullable();
            $table->string('gender');
            $table->string('qualification');
            $table->string('avatar');
            $table->string('adjective');
            $table->string('nationality');
            // for nutritionist to patients relation (1 to *)
            $table->unsignedBigInteger('nutritionist_id');
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
