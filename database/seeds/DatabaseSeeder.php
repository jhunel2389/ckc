<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * php artisan make:seeder UsersTableSeeder
     * composer dump-autoload
     * php artisan db:seed
     * php artisan db:seed --class=UsersTableSeeder
     * @return void
     */
    public function run()
    {
        $this->call([
	        UsersTableSeeder::class,
            RolesTableSeeder::class,
            PermissionTableSeeder::class,
            RolesPermissionTableSeeder::class,
	    ]);
    }
}
