<?php

namespace App\Models;
// Authの機能を要れる
use Illuminate\Foundation\Auth\User as Authenticatable;
// 論理削除(softdelete)のtraitを入れる
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    // 論理削除(softdelete)のtraitを入れる
    use SoftDeletes;

    // SoftDeletesのcolumnを指定する
    protected $dates = ['deleted_at'];

    //　記入不可のコラムの設定
    protected $guarded = [];
    // パスワードを非表示
    protected $hidden = [
        'password', 'remember_token',
    ];

   


}
