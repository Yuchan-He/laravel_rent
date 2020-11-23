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
        // DB::table('role_node') -> truncate();
        
        DB::table('role_node') -> truncate();
        $data = [
            ['role_id' => 1,
             'node_id' => 1 ],

            ['role_id' => 1,
             'node_id' => 2 ],

            ['role_id' => 1,
             'node_id' => 3 ],

            ['role_id' => 1,
             'node_id' => 4 ]                              
        ];


        for($i = 0; $i <10 ; $i++){
        	$data[] = [
        		'role_id' => rand(1,5),
        		'node_id' => rand(1,5)	
        	];
        }
        DB::table('role_node') -> insert($data);
    }
}
