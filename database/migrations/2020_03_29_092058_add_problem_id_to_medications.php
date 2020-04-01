<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProblemIdToMedications extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('medications', function (Blueprint $table) {
            $table->integer('problem_id')->after('consultation_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('medications', function (Blueprint $table) {
        });
    }
}
