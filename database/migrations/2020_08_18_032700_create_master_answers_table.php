<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('answer');
            $table->boolean('answer_stat')->default(true);
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
        Schema::dropIfExists('master_answers');
    }
}
