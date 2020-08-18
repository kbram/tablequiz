<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizCategoryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_category_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('local_path');
            $table->string('public_path');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('quiz_categories')->onDelete('cascade');
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
        Schema::dropIfExists('quiz_category_images');
    }
}
