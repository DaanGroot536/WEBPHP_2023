<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->integer('labelID')->nullable();
            $table->integer('pickupID')->nullable();
            $table->string('trackandtracecode')->nullable();
            $table->string('webshopName');
            $table->string('webshopStreet');
            $table->string('webshopHousenumber');
            $table->string('webshopZipcode');
            $table->string('webshopCity');
            $table->string('customerStreet');
            $table->string('customerHousenumber');
            $table->string('customerZipcode');
            $table->string('customerCity');
            $table->string('status');
            $table->string('dimensions');
            $table->integer('weight');

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
        Schema::dropIfExists('packages');
    }
}
