<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFootbridgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footbridges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipality_id');
            $table->string('name');
            $table->string('availability');
            $table->string('description');
            $table->string('position');
            $table->string('views');
            $table->string('frontal');
            $table->string('crusade');
            $table->string('mega');
            $table->string('side');
            $table->string('street');
            $table->string('reference_c');
            $table->string('reference_n');
            $table->string('reference_s');
            $table->string('reference_o');
            $table->string('reference_p');
            $table->integer('order')->nullable();
            $table->string('latitude');
            $table->string('length');
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
        Schema::drop('footbridges');
    }
}
