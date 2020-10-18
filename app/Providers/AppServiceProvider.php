<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// 自定验证规则，先引入validate门面
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // // 自定义验证规则
        Validator::extend('mobile',function($attribute,$value,$parameters,$validator){
            // 返回true | false
            $reg = '/^0[789]0-[0-9]{4}-[0-9]{4}$/';
            // 正则表达式匹配
            return preg_match($reg,$value);
        });
    }
}
