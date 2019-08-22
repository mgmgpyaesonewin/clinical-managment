<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('investigations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('term');
            $table->string('value');
            $table->string('consultation_id');
            $table->string('doctor_id');
            $table->string('code')->default('NN');
            $table->string('snomed_ct')->default('aevrawer');
            $table->string('range')->nullable();
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
        Schema::dropIfExists('investigations');
    }
}
