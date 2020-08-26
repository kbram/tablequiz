<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizRoundImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_round_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('local_path');
            $table->string('public_path');
            $table->string('thumb_path');
            $table->bigInteger('round_id')->unsigned();
            $table->foreign('round_id')->references('id')->on('quiz_rounds')->onDelete('cascade');
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
        Schema::dropIfExists('quiz_round_images');
    }
}
