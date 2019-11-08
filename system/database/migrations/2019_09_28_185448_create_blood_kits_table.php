<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_kits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('donor_id');
            $table->boolean('active')->default(false);
            $table->string('din')->nullable();
            $table->dateTime('order_date')->nullable();
            $table->dateTime('recieve_date')->nullable();
            $table->string('shipping_service')->nullable();
            $table->string('tracking_number')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('blood_kits');
    }
}
