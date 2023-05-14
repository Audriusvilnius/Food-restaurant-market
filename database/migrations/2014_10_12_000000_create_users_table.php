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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('role', 20)->default('customer');
            $table->unsignedBigInteger('rest_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->text('street', 500)->nullable();
            $table->text('build', 500)->nullable();
            $table->text('postcode', 500)->nullable();
            $table->string('phone', 500)->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('rest_id')->references('id')->on('restaurants');
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
        Schema::dropIfExists('users');
    }
};
