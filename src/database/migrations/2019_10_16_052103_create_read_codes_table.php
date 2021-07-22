<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('read_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('block_id')->nullable();
            $table->string('title');
            $table->string('class_kind');
            $table->string('depth_in_kind');
            $table->string('is_residual');
            $table->string('chapter_no');
            $table->string('is_leaf');
            $table->string('no_of_non_residual_children');
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
        Schema::dropIfExists('read_codes');
    }
}
