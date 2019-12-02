<?php

use Illuminate\Database\Seeder;

class RolesPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rp = [
    		[
				"role_key" => "admin_user",
				"permission_key" => "view_dashboard",
			]
    	];

    	foreach ($rp as $key => $value) {
    		$rp_key = DB::table('roles_permission')->where('role_key', '=', $value['role_key'])->where('permission_key', '=', $value['permission_key'])->first();
	        if ($rp_key === null) {
	            DB::table('roles_permission')->insert([
	                'role_key' => $value['role_key'],
	                'permission_key' => $value['permission_key'],
	            ]);
	        }
    	}
    }
}
