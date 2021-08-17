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
            $table->string('value')->nullable();
            $table->string('consultation_id')->nullable();
            $table->string('patient_id');
            $table->string('doctor_id')->nullable();
            $table->string('code')->nullable();
            // $table->string('snomed_ct')->default('aevrawer');
            $table->string('range')->nullable();
            $table->string('type')->nullable();
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
