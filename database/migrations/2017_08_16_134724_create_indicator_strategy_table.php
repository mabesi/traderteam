<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicatorStrategyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicator_strategy', function (Blueprint $table) {
            $table->integer('indicator_id')->unsigned();
            $table->foreign('indicator_id')->references('id')->on('indicators')->onDelete('cascade');
            $table->integer('strategy_id')->unsigned();
            $table->foreign('strategy_id')->references('id')->on('strategies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicator_strategy');
    }
}
