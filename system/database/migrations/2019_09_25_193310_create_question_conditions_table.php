<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_conditions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('field_id');
            $table->integer('question_condition_type_id');
            $table->integer('question_condition_action_id');
            $table->string('condition');
            $table->boolean('show_date_field')->default(false);
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
        Schema::dropIfExists('question_conditions');
    }
}
