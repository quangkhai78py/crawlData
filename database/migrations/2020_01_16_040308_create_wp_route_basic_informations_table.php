<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpRouteBasicInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wp_route_basic_informations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('departure_id')->nullable();
            $table->integer('arrival_id')->nullable();
            $table->string('departure_weather');
            $table->string('departure_weather_icon');
            $table->string('arrival_weather');
            $table->string('arrival_weather_icon');
            $table->integer('transportation_type');
            $table->integer('transport_duration');
            $table->integer('price');
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
        Schema::dropIfExists('wp_route_basic_informations');
    }
}
