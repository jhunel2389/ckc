<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$roles = [
    		[
				"role_key" => "admin_user",
				"description" => "Admin User",
			],
			[
				"role_key" => "super_user",
				"description" => "Super User",
			],
			[
				"role_key" => "user",
				"description" => "User",
			],
    	];

    	foreach ($roles as $key => $value) {
    		$role_key = DB::table('roles')->where('role_key', '=', $value['role_key'])->first();
	        if ($role_key === null) {
	            DB::table('roles')->insert([
	                'role_key' => $value['role_key'],
	                'description' => $value['description'],
	            ]);
	        }
    	}
        
    }
}
