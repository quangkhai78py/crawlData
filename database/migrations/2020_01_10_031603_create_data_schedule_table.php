<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_schedule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('departure_and_arrival')->nullable();
            $table->string('date_time')->nullable();
            $table->string('departure_time')->nullable();
            $table->string('departure')->nullable();
            $table->string('ship_type')->nullable();
            $table->string('arrival_port')->nullable();
            $table->string('flight_status')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('data_schedule');
    }
}
