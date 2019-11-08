<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormQuestionMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_question_maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('form_id');
            $table->integer('question_id');
            $table->integer('field_id');
            $table->string('table');
            $table->string('column');
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
        Schema::dropIfExists('form_question_maps');
    }
}
