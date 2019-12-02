<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
    		[
				"permission_key" => "view_dashboard",
				"description" => "View Dashboard",
			],
            [
                "permission_key" => "view_system",
                "description" => "View System",
            ],
            [
                "permission_key" => "view_report",
                "description" => "View Report",
            ],
            [
                "permission_key" => "view_teams",
                "description" => "View Teams",
            ],
            [
                "permission_key" => "view_roles",
                "description" => "View Roles",
            ],
            [
                "permission_key" => "view_tools",
                "description" => "View Tools",
            ],
            [
                "permission_key" => "view_tools_proficiency",
                "description" => "View Tools Proficiency",
            ],
            [
                "permission_key" => "view_training_status",
                "description" => "View Training Status",
            ]
    	];

    	foreach ($permission as $key => $value) {
    		$permission_key = DB::table('permission')->where('permission_key', '=', $value['permission_key'])->first();
	        if ($permission_key === null) {
	            DB::table('permission')->insert([
	                'permission_key' => $value['permission_key'],
	                'description' => $value['description'],
	            ]);
	        }
    	}
    }
}
