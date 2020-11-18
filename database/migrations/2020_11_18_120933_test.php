<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Test extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('test', function (Blueprint $table) {
            $table->bigIncrements('id');
            // 追加
            $table -> string('title',200) -> comment('タイトル');
            $table -> string('file',255) -> nullable() -> change() -> comment('webuploader');                       
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
