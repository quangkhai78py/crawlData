<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpRouteInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wp_route_informations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('departure_id');
            $table->integer('arrival_id');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->integer('transportation_type_id');
            $table->tinyInteger('status')->comment = '1:ok 2:cancel';
            $table->integer('price');
            $table->integer('price_label');
            $table->integer('service_company_id');
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
        Schema::dropIfExists('wp_route_informations');
    }
}
