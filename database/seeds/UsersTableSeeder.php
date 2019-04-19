<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            [
                'first_name' => 'Super',
                'last_name' => 'Administrator',
                'role_id' => 1,
                'email' => 'sa@laundo.com',
                'password' => bcrypt('superadmin'),
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'role_id' => 2,
                'email' => 'a@laundo.com',
                'password' => bcrypt('admin'),
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'first_name' => 'Tito',
                'last_name' => 'Eds',
                'role_id' => 3,
                'email' => 'te@laundo.com',
                'password' => bcrypt('admin'),
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'first_name' => 'Tito',
                'last_name' => 'Mark',
                'role_id' => 4,
                'email' => 'tm@laundo.com',
                'password' => bcrypt('employee'),
                'created_at' => \Carbon\Carbon::now()
            ]
        );

        // Insert to DB array of users
        User::insert($users);
    }
}
