<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            [
                'type' => 'superadmin',
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'type' => 'admin',
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'type' => 'manager',
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'type' => 'employee',
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'type' => 'customer',
                'created_at' => \Carbon\Carbon::now()
            ],
        );

        Role::insert($roles);
    }
}
