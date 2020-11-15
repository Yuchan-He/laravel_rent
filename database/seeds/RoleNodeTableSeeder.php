<?php

use Illuminate\Database\Seeder;

class RoleNodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('role_node') -> truncate();
        $data = [];

        for($i = 0; $i <10 ; $i++){
        	$data[] = [
        		'role_id' => rand(1,10),
        		'node_id' => rand(1,10)	
        	];
        }
        DB::table('role_node') -> insert($data);
    }
}
