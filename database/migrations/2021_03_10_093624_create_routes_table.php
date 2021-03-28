<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('airline', 3);
            $table->integer('airline_id');
            $table->string('source', 3);
            $table->foreignId('source_id')->constrained('airports');
            $table->string('destination', 3);
            $table->foreignId('destination_id')->constrained('airports');;
            $table->string('codeshare', 1);
            $table->integer('stops');
            $table->string('equipment');
            $table->decimal('price', 18,4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
