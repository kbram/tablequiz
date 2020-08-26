<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalQuestionMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_question_medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('media_link')->nullable();
            $table->string('media_type');
            $table->string('local_path')->nullable();
            $table->string('public_path')->nullable();
            $table->bigInteger('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('global_questions');
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
        Schema::dropIfExists('global_question_medias');
    }
}
