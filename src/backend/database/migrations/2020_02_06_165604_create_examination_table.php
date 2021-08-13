<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('examination', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('values');
            $table->integer('problem_id');
            $table->integer('consultation_id');
            $table->integer('patient_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('examination');
    }
}
