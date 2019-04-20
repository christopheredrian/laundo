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
                'role' => User::USER_ROLE_ADMIN,
                'email' => 'sa@laundo.com',
                'password' => bcrypt('superadmin'),
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'role' => User::USER_ROLE_ADMIN,
                'email' => 'a@laundo.com',
                'password' => bcrypt('admin'),
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'first_name' => 'Tito',
                'last_name' => 'Eds',
                'role' => User::USER_ROLE_ADMIN,
                'email' => 'te@laundo.com',
                'password' => bcrypt('manager'),
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'first_name' => 'Tito',
                'last_name' => 'Mark',
                'role' => User::USER_ROLE_EMPLOYEE,
                'email' => 'tm@laundo.com',
                'password' => bcrypt('employee'),
                'created_at' => \Carbon\Carbon::now()
            ],
            [
            'first_name' => 'Mr.',
            'last_name' => 'Customer',
            'role_id' => 4,
            'email' => 'customer@laundo.com',
            'password' => bcrypt('customer'),
            'created_at' => \Carbon\Carbon::now()
            ],
        );

        // Insert to DB array of users
        User::insert($users);
    }
}
