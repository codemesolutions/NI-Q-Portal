<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("form_id");
            $table->string("name");
            $table->string('url');
            $table->binary('redirect_url');
            $table->binary("description")->nullable();
            $table->binary('keywords')->nullable();
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('form_pages');
    }
}
