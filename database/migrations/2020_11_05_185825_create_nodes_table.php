<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table -> bigIncrements('id');

            $table -> string('name',50) -> comment('nodes_name');
            $table -> string('route_name',100) -> default('') -> comment('route別名、権限判断の根拠');
            $table -> unsignedInteger('pid') -> nullable() -> comment('上位権限');
            $table -> enum('is_menu',['0','1']) -> default('0') -> comment('一段階のメンユーがあるか、1はあり');
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
        Schema::dropIfExists('nodes');
    }
}
