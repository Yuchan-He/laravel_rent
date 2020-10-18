<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        // ランダムなデータを作成
        // fakerのデータの型はmigrationsの中の設定は一致すべき
        'username' 	=> $faker -> name(20),
        'password'	=> bcrypt('12345678'),
        'sex'		=> rand(1,3),
        'phone'	=> $faker -> phoneNumber,
        'email'		=> $faker -> email,
        'created_at'=> date('Y-m-d H:i:s',time())

    ];
});
