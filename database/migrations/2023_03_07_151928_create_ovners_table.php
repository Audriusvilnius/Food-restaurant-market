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
        Schema::create('ovners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ovner_id')->unsigned()->nullable();
            $table->string('title',100);
            $table->text('street',500)->nullable();
            $table->text('country',500)->nullable();
            $table->text('build',500)->nullable();
            $table->text('postcode',500)->nullable();
            $table->text('city',100)->nullable();
            $table->string('phone',100)->nullable();
            $table->string('mobile',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('url',100)->nullable();
            $table->string('account',100)->nullable();
            $table->text('bank',100)->nullable();
            $table->time('open')->nullable();
            $table->time('close')->nullable();
            $table->string('add',500)->nullable();
            $table->text('des')->nullable();
            $table->string('photo',500)->nullable();
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
        Schema::dropIfExists('ovners');
    }
};