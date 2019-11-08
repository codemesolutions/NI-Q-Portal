<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilkKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milk_kits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('donor_id');
            $table->boolean('active')->default(false);
            $table->string('barcode')->nullable();
            $table->string('volume')->nullable();
            $table->boolean('genetic_test_results')->default(false);
            $table->boolean('microbial_test_results')->default(false);
            $table->boolean('toxicology_test_result')->default(false);
            $table->dateTime('finalized_date')->nullable();
            $table->dateTime('paid_date')->nullable();
            $table->dateTime('quarantine_date')->nullable();
            $table->dateTime('received_date')->nullable();
            $table->string('pallet')->nullable();
            $table->string('shipping_service')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('lot_barcode')->nullable();
            $table->dateTime('best_by_date')->nullable();
            $table->boolean("closed")->default(false);
            $table->boolean('transferred')->default(false);
            $table->integer('total_cases')->default(0);
            $table->integer('cases_remaining')->default(0);
            $table->integer('sample_pouches')->default(0);
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
        Schema::dropIfExists('milk_kits');
    }
}
