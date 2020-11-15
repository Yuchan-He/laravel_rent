<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavsTable extends Migration
{
    /**
     * Fav table
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favs', function (Blueprint $table) {
            $table -> bigIncrements('id');
            $table -> string('openid',100) -> default('');
            // 【error】字符串默认可以为空，数值型不能为空，可以设置为0，$table -> unsignedInteger('article_id') -> default('') -> comment('link to table article');  
            $table -> unsignedInteger('article_id') -> default(0) -> comment('link to table article'); 
            $table -> timestamps();
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
        Schema::dropIfExists('favs');
    }
}
