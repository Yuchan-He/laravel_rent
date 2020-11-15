<?php

use Illuminate\Database\Seeder;

class NodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('nodes') -> truncate();
        $data = [
            // admin 権限
            ['name' => 'ユーザー管理',
            'route_name' => 'admin.user.index',
            'pid' => rand(0,1),
            'is_menu' => '1'],

            ['name' => 'ユーザー削除',
            'route_name' => 'admin.user.indexdeleted',
            'pid' => rand(0,1),
            'is_menu' => '1'],

            ['name' => '役割管理',
            'route_name' => 'admin.role.index',
            'pid' => rand(0,1),
            'is_menu' => '1'],

            ['name' => '権限管理',
            'route_name' => 'admin.node.index',
            'pid' => rand(0,1),
            'is_menu' => '1'], 

            // ユーザー 権限
            ['name' => '文章管理',
            'route_name' => 'admin.article.index',
            'pid' => rand(0,1),
            'is_menu' => '1'],                                    

        ];

        DB::table('nodes') -> insert($data);

        // DB::table('nodes') -> insert([
        // 	'name' => 'ユーザー管理',
        // 	'route_name' => 'admin.user.index',
        // 	'pid' => rand(0,1),
        // 	'is_menu' => '1'
        // ]);        
    }
}
