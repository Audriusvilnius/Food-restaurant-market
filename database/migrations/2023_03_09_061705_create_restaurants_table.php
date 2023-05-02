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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('addres', 500)->nullable();
            $table->string('photo', 500)->nullable();
            $table->string('open', 100)->nullable();
            $table->string('close', 100)->nullable();
            $table->string('phone', 500)->nullable();
            $table->text('des_lt', 500)->nullable();
            $table->text('des_en', 500)->nullable();
            $table->timestamps();
            // $table->unsignedBigInteger('food_id')->unsigned();
            // $table->unsignedBigInteger('rest_city_id')->unsigned();
            // $table->time('open')->nullable();
            // $table->time('close')->nullable();
            // $table->string('city',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
};
