<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            // 追加
            $table -> string('title',200) -> comment('タイトル');
            $table -> unsignedInteger('user_id') -> default(0);
            $table -> string('desn',100) -> comment('摘要') -> nullable();              
            $table -> string('pic',255) -> nullable() -> comment('写真');         
            $table -> string('file',255) -> nullable() -> comment('webuploader');
            $table -> text('body') -> comment('内容');            
            $table->timestamps();
            $table -> softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
