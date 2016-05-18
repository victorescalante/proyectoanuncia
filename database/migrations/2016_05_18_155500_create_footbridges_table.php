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
            $table->string('name');
            $table->string('availability')->
            $table->string('description');
            $table->string('order');
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
