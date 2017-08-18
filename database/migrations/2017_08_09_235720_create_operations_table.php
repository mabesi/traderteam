<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('strategy_id')->unsigned();
            $table->foreign('strategy_id')->references('id')->on('strategies');
            $table->string('gtime',1);
            $table->string('stock',50);
            $table->string('buyorsell',1);
            $table->string('realorsimulated',1);
            $table->decimal('preventry',10,2);
            $table->decimal('prevtarget',10,2);
            $table->decimal('prevstop',10,2);
            $table->decimal('realentry',10,2);
            $table->decimal('realexit',10,2);
            $table->date('entrydate');
            $table->date('exitdate');
            $table->text('preanalysis');
            $table->string('preimage1',50);
            $table->string('preimage2',50);
            $table->text('postanalysis');
            $table->string('postimage1',50);
            $table->string('postimage2',50);
            $table->text('lessonslearned');
            $table->string('status',1);
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
        Schema::dropIfExists('operations');
    }
}
