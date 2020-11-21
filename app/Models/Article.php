<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Base
{

    // 关联用户表表格查询
    public function user(){
        return $this -> belongsTo(User::class,'user_id');
    }

    

}
