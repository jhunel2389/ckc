<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan make:seeder UsersTableSeeder
     * composer dump-autoload
     * php artisan db:seed
     * php artisan db:seed --class=UsersTableSeeder
     * @return void
     */
    public function run()
    {
        $superadmin = DB::table('users')->where('username', '=', 'superadmin')->first();
        if ($superadmin === null) {
            DB::table('users')->insert([
                'firstname' => "Super",
                'lastname' => "Admin",
                'username' => "superadmin",
                'email' => "superadmin@noemail.com",
                'password' => bcrypt('P@ssw0rd'),
                'role_key' => "admin_user",
            ]);
        }
        
    }
}
