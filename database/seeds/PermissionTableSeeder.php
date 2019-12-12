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
            ],
            [
                "permission_key" => "add_teams",
                "description" => "System Teams Add",
            ],
            [
                "permission_key" => "edit_teams",
                "description" => "System Teams Edit",
            ],
            [
                "permission_key" => "disable_teams",
                "description" => "System Teams Disable",
            ],
            [
                "permission_key" => "delete_teams",
                "description" => "System Teams Delete",
            ],
            [
                "permission_key" => "view_user_profile",
                "description" => "User Profile View",
            ],
            [
                "permission_key" => "edit_user_profile",
                "description" => "User Profile Edit",
            ],
            [
                "permission_key" => "disable_user_profile",
                "description" => "User Profile Disable",
            ],
            [
                "permission_key" => "delete_user_profile",
                "description" => "User Profile Delete",
            ],
            [
                "permission_key" => "assign_system_role_user_profile",
                "description" => "User Profile Assign System Role",
            ],
            [
                "permission_key" => "add_tools",
                "description" => "System Tools Add",
            ],
            [
                "permission_key" => "edit_tools",
                "description" => "System Tools Edit",
            ],
            [
                "permission_key" => "disable_tools",
                "description" => "System Tools Disable",
            ],
            [
                "permission_key" => "delete_tools",
                "description" => "System Tools Delete",
            ],
            [
                "permission_key" => "add_employee_roles",
                "description" => "System Employee Roles Add",
            ],
            [
                "permission_key" => "edit_employee_roles",
                "description" => "System Employee Roles Edit",
            ],
            [
                "permission_key" => "disable_employee_roles",
                "description" => "System Employee Roles Disable",
            ],
            [
                "permission_key" => "delete_employee_roles",
                "description" => "System Employee Roles Delete",
            ],
            [
                "permission_key" => "view_system_roles",
                "description" => "System Roles View",
            ],
            [
                "permission_key" => "edit_system_roles",
                "description" => "System Roles Edit",
            ],
            [
                "permission_key" => "view_training_tools",
                "description" => "View Traing Tools",
            ],
            [
                "permission_key" => "add_training_tools",
                "description" => "System Training Tools Add",
            ],
            [
                "permission_key" => "edit_training_tools",
                "description" => "System Training Tools Edit",
            ],
            [
                "permission_key" => "disable_training_tools",
                "description" => "System Training Tools Disable",
            ],
            [
                "permission_key" => "delete_training_tools",
                "description" => "System Training Tools Delete",
            ],
            [
                "permission_key" => "view_bookmarks",
                "description" => "View Bookmarks Tools",
            ],
            [
                "permission_key" => "add_bookmarks",
                "description" => "System Training Tools Add",
            ],
            [
                "permission_key" => "edit_bookmarks",
                "description" => "System Bookmarks Tools Edit",
            ],
            [
                "permission_key" => "disable_bookmarks",
                "description" => "System Bookmarks Tools Disable",
            ],
            [
                "permission_key" => "delete_bookmarks",
                "description" => "System Bookmarks Tools Delete",
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
