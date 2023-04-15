<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            
            $table->id();
            $table->string('city',100)->nullable();
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('rest_id');
            $table->unsignedBigInteger('city_no');
            $table->timestamps();
            // $table->foreign('food_id')->references('id')->on('food');
            // $table->foreign('rest_id')->references('id')->on('restaurants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
};