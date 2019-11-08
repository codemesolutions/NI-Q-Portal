<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormPageFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_page_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('form_page_id');
            $table->string('name');
            $table->string('type');
            $table->string('input_id')->nullable();
            $table->string('class')->nullable();
            $table->string('placeholder')->nullable();
            $table->string('style')->nullable();
            $table->binary('value')->nullable();
            $table->string('label')->nullable();
            $table->string('helper_text')->nullable();
            $table->binary('options')->nullable();
            $table->integer('position')->default(0);
            $table->string('mapped_table')->nullable();
            $table->string('mapped_column')->nullable();
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
        Schema::dropIfExists('form_page_fields');
    }
}
