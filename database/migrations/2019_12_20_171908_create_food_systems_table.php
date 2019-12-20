<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_systems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            //added by us
            $table->string('breakfast');
            $table->string('morning_snac');
            $table->string('lunch');
            $table->string('evening_snack');
            $table->string('dinner');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('users');
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
        Schema::dropIfExists('food_systems');
    }
}
