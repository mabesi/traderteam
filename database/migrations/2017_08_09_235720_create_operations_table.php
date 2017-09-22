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
            $table->foreign('strategy_id')->references('id')->on('strategies')->onDelete('cascade');
            $table->string('gtime',1);
            $table->string('stock',50);
            $table->integer('amount')->unsigned();
            $table->string('buyorsell',1);
            $table->string('realorsimulated',1);
            $table->decimal('preventry',10,2);
            $table->decimal('prevtarget',10,2);
            $table->decimal('prevstop',10,2);
            $table->text('preanalysis')->nullable();
            $table->string('preimage',100)->default('|||');
            $table->decimal('realentry',10,2)->nullable();
            $table->decimal('currentstop',10,2)->nullable();
            $table->decimal('realexit',10,2)->nullable();
            $table->decimal('fees',10,2)->nullable();
            $table->decimal('result',10,2)->default(0);
            $table->date('entrydate')->nullable();
            $table->date('exitdate')->nullable();
            $table->text('postanalysis')->nullable();
            $table->string('postimage',100)->nullable();
            // N: Nova; A: Alterada; I: Iniciada; M: Stop Movido;
            // S: Stopada; T: Finalizada;
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
