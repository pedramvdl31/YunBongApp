<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //USERS
        DB::table('users')->insert([
            [
                'id' => '1',
                'username' => 'pedram',
                'email' => 'pedramkhoshnevis@gmail.com',
                'roles' => '1',
                'password' => bcrypt('110110')
            ]
         ]);
        DB::table('users')->insert([
            [
                'id' => '2',
                'username' => 'example',
                'email' => 'example@example.com',
                'roles' => '5',
                'password' => bcrypt('110110')
            ]
         ]);
        DB::table('users')->insert([
            [
                'id' => '3',
                'username' => 'josh',
                'email' => 'example2@example.com',
                'roles' => '5',
                'password' => bcrypt('110110')
            ]
         ]);
        //ROLES
        DB::table('roles')->insert([
            [
                'id' => '1',
                'role_title' => 'Superadmins',
                'role_slug' => 'superadmins'
            ],
            [
                'id' => '2',
                'role_title' => 'Admins',
                'role_slug' => 'admins'
            ],
            [
                'id' => '3',
                'role_title' => 'Admins (Simple)',
                'role_slug' => 'admins'
            ],
            [
                'id' => '4',
                'role_title' => 'Employees',
                'role_slug' => 'employees'
            ],
            [
                'id' => '5',
                'role_title' => 'Users',
                'role_slug' => 'users'
            ],
            [
                'id' => '6',
                'role_title' => 'Guest',
                'role_slug' => 'Guest'
            ]

        ]);
        //ROLEUSER
        DB::table('role_user')->insert([
            [
                'id' => '1',
                'role_id' => '1',
                'user_id' => '1'
            ]
        ]);
        //ROLEUSER
        DB::table('role_user')->insert([
            [
                'id' => '3',
                'role_id' => '1',
                'user_id' => '1'
            ]
        ]);
    }
}