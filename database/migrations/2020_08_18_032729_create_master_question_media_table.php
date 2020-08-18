<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterQuestionMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_question_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('media_link')->nullable();
            $table->string('media_type');
            $table->string('local_path')->nullable();
            $table->string('public_path')->nullable();
            $table->bigInteger('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('master_questions');
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
        Schema::dropIfExists('master_question_media');
    }
}
