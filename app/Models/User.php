<?php

namespace App\Models;
// Authの機能を要れる
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //　記入不可のコラムの設定
    protected $guarded = [];
    // パスワードを非表示
    protected $hidden = [
        'password', 'remember_token',
    ];

    // ユーザーを追加する
    // public function addUser($data){
    	

    // }

}
