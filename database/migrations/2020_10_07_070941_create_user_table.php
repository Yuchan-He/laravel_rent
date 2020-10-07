<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table -> bigIncrements('id');
            $table -> string('username',20) -> notNull();
            $table -> string('password',255) -> notNull();
            $table -> string('email',20) -> default('');
            $table -> string('phone',15) -> default('');
            $table -> enum('sex',['Woman','Man']) -> default('Woman');
            $table -> softDeletes();
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
