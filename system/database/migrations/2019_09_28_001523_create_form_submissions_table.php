<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('form_id');
            $table->integer('question_id');
            $table->integer('user_id');
            $table->boolean('completed')->default(false);
            $table->boolean('is_new')->default(true);
            $table->boolean('blocked')->default(false);
            $table->boolean('waited')->default(false);
            $table->date('waited_time')->nullable();
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
        Schema::dropIfExists('form_submissions');
    }
}
