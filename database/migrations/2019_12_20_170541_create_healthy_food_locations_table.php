<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthyFoodLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('healthy_food_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            // added by us
            $table->string('place_name');
            $table->float('longitude');
            $table->float('latitude');
            $table->string('working_time');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('healthy_food_locations');
    }
}
