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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rest_id')->unsigned();
            $table->unsignedBigInteger('food_city_no')->unsigned();
            $table->unsignedBigInteger('food_category_no')->unsigned();
            $table->string('title_en', 100);
            $table->string('title_lt', 100);
            $table->string('rest_title', 100)->nullable();
            $table->decimal('price', 5, 2)->unsigned()->nullable();
            $table->decimal('rating', 4, 2)->unsigned()->default(0);
            $table->text('rating_json')->nullable();
            $table->decimal('counts', 4, 0)->unsigned()->default(0);
            $table->string('photo', 500)->nullable()->nullable();
            $table->string('add', 500)->nullable();
            $table->text('des_en')->nullable();
            $table->text('des_lt')->nullable();
            $table->foreign('rest_id')->references('id')->on('restaurants');
            $table->foreign('food_city_no')->references('id')->on('cities');
            $table->foreign('food_category_no')->references('id')->on('categories');
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
        Schema::dropIfExists('food');
    }
};
