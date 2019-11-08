<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('donor_number');
            $table->string('date_of_birth');
            $table->string('mailing_address');
            $table->string('mailing_address2')->nullable();
            $table->string('mailing_city');
            $table->string('mailing_state');
            $table->string('mailing_zipcode');
            $table->string('shipping_address')->nullable();
            $table->string('shipping_address2')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_zipcode')->nullable();
            $table->string('phone_home')->nullable();
            $table->string('phone_cell')->nullable();
            $table->boolean('use_mailing_address')->default(false);
            $table->boolean('recieved_consent_form')->default(false);
            $table->boolean('recieved_finacial_form')->default(false);
            $table->string('consent_form')->nullable();
            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('donors');
    }
}
