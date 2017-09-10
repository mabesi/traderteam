<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('occupation',50)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('city',60)->nullable();
            $table->string('state',50)->nullable();
            $table->string('country',2)->nullable();
            $table->string('site',50)->nullable();
            $table->string('facebook',50)->nullable();
            $table->string('twitter',50)->nullable();
            $table->text('description')->nullable();
            $table->decimal('capital',10,2)->default(100000.00);
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
        Schema::dropIfExists('profiles');
    }
}
