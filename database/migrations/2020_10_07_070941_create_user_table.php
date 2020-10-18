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
        Schema::create('users', function (Blueprint $table) {
            $table -> bigIncrements('id');
            $table -> string('username',20) -> notNull();
            $table -> string('password',255) -> notNull();
            $table -> string('email',50) -> default('');
            $table -> string('phone',16) -> default('');
            $table -> enum('sex',[1,2,3]);
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
