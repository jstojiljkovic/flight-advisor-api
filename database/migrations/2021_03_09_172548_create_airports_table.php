<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('country');
            $table->string('iata', 3)->nullable();
            $table->string('icao', 4)->nullable();
            $table->decimal('latitude', 8,6);
            $table->decimal('longitude', 9,6);
            $table->integer('altitude');
            $table->string('timezone');
            $table->string('dst', 1);
            $table->string('tz');
            $table->string('type');
            $table->string('source');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airports');
    }
}
