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
            $table->text('preanalysis');
            $table->string('preimage',100);
            $table->decimal('realentry',10,2)->nullable();
            $table->decimal('realexit',10,2)->nullable();
            $table->date('entrydate')->nullable();
            $table->date('exitdate')->nullable();
            $table->text('postanalysis')->nullable();
            $table->string('postimage',100)->nullable();
            // N: Nova; A: Alterada; C: Cancelada; I: Iniciada; S: Stopada; F: Finalizada;
            $table->string('status',1)->default('N');
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
