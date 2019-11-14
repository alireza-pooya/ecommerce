<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class   CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('product_property', function (Blueprint $table) {
            $table->text('value');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('property_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('property_id')->references('id')->on('properties');
            $table->primary(['product_id','property_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
