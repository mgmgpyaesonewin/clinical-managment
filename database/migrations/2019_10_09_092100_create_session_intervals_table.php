<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionIntervalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_intervals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('session_id');
            $table->string('start_interval_time');
            $table->string('end_interval_time');
            $table->string('date');
            $table->string('booked');
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
        Schema::dropIfExists('session_intervals');
    }
}
