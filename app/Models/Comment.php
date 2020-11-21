<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Base
{
    // 关联文章表格查询
    public function article(){
        return $this -> belongsTo(Article::class,'article_id');
    }

    // 关联comment查询
    public function user(){
        return $this -> belongsTo(User::class,'user_id');
    }
}
