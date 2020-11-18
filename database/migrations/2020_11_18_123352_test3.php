<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Test3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('test3', function (Blueprint $table) {
            $table->bigIncrements('id');
            // 追加
            $table -> string('title',200) -> comment('タイトル');
            $table -> string('file',255) -> nullable() ->comment('webuploader');            
            $table -> string('pic',255) -> nullable() ->comment('webuploader');
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
        //
    }
}
