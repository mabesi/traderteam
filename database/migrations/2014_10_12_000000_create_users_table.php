<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('type',1)->default('U');
            $table->unsignedTinyInteger('rank')->default(0);
            $table->string('avatar',50)->default('default.png');
            $table->boolean('confirmed')->default(False);
            $table->boolean('locked')->default(True);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
