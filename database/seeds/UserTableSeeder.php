<?php

use Illuminate\Database\Seeder;
// 関連するのModelを入れる
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	// 元のデータをクリアする
    	User::truncate();
        // factoryでdataを補充する
        factory(User::class,50) -> create();
        // adminユーザーを指定する
        User::where('id',1) -> update(
            ['username' => 'admin',
             'role_id' => 1
            ]);
        
    }
}
