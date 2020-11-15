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
            $table -> string('desn',255) -> default('') -> comment('文章摘要');
            $table -> string('pic',100) -> default('') -> comment('写真');
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
