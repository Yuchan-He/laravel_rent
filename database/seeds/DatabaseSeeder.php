<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 系统期初默认 $this->call(UsersTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(NodeTableSeeder::class);
        $this->call(RoleNodeTableSeeder::class);
        $this->call(RoleTableSeeder::class);

    }
}
