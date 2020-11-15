<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('roles') -> truncate();
        // $data = [];
        $data = [
            ['roleName' => '管理人'],
            ['roleName' => 'スタッフ'],
            ['roleName' => '会員'],
            ['roleName' => 'ユーザー'],
        ];
        DB::table('roles') -> insert($data);
    }
}
