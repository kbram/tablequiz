<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceBandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_bands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('from')->unigned();
            $table->integer('to')->unsigned();
            $table->string('band_type');
            $table->decimal('cost',8,2)->unsigned();
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
        Schema::dropIfExists('prize_bands');
    }
}
