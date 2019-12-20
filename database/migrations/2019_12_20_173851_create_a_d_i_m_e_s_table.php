<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateADIMESTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_d_i_m_e_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            // added by us
            $table->Float('target_weight');
            $table->Float('length');
            $table->Float('weight');
            $table->integer('water');
            $table->integer('coffee');
            $table->integer('tea');
            $table->boolean('meat_do_not_eat');
            $table->boolean('cereal_do_not_eat');
            $table->boolean('vegetables_do_not_eat');
            $table->boolean('fruits_do_not_eat');
            $table->boolean('fast_food');
            $table->boolean('home_food');
            $table->boolean('healthy_food');
            $table->boolean('natural_juices');
            $table->boolean('juices');
            $table->boolean('soda');
            $table->boolean('work_nature');
            $table->boolean('nature_sleep');
            $table->string('physical_activity');
            $table->string('walking');
            $table->string('running');
            $table->string('swedish_exercises');
            $table->string('body_building');
            $table->boolean('diabetes');
            $table->boolean('blood_pressure');
            $table->boolean('heart_and_arteries');
            $table->boolean('high_cholesterol_blood');
            $table->boolean('high_triglycerides');
            $table->boolean('thyroid');
            $table->boolean('fine');
            $table->boolean('other_diseases');
            $table->boolean('medicine');
            $table->boolean('vitamins');
            $table->boolean('surgeries');
            $table->boolean('nausea_vomiting');
            $table->boolean('gastritis');
            $table->boolean('diarrhea');
            $table->boolean('constipation');
            $table->boolean('gluten_intolerance');
            $table->boolean('lactose_intolerance');
            $table->boolean('ulcer');
            $table->boolean('difficultie_swallowing');
            $table->boolean('good_health');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('a_d_i_m_e_s');
    }
}
