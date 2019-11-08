<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionFieldQuestionFieldValidationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_field_question_field_validation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('question_field_id');
            $table->integer('question_field_validation_id');
            $table->string('value')->nullable();
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
        Schema::dropIfExists('question_field_question_field_validation');
    }
}
