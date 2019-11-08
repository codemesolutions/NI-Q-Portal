<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('question_id');
            $table->integer('question_field_type_id');
            $table->string('name');
            $table->string('value')->nullable();
            $table->string('label')->nullable();
            $table->longText('options')->nullable();
            $table->string('download')->nullable();
            $table->integer('field_order')->default(0);
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
        Schema::dropIfExists('question_fields');
    }
}
