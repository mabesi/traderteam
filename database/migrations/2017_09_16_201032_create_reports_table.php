<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('reported_id')->unsigned();
            $table->foreign('reported_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('origin_url');
            //1:Perfil Falso|2:Perfil Clonado|3:Comportamento Inadequado|4:Infração de Regras
            //5:Racismo e Preconceito|6:Spam|7:Assédio|8:Segurança|9:Conteúdo Impróprio|10:Outros
            $table->string('reason',1);
            $table->text('description');
            $table->string('link')->nullable();
            $table->string('resolution')->nullable();
            $table->boolean('finished')->default(False);
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
        Schema::dropIfExists('reports');
    }
}
