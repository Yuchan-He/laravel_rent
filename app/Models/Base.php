<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// 添加SoftDeletes
use Illuminate\Database\Eloquent\SoftDeletes;

class Base extends Model
{
	// 设置软删除
	use SoftDeletes;
	protected $datas = ['deleted_at'];
    // 设置黑名单
    protected $guarded = [];
}

