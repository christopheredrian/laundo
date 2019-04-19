<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Add as needed for new migrations but be CAUTIOUS! :)
        // Get UsersTableSeeder from seanyboyswag
         $this->call([
             RolesTableSeeder::class,
             UsersTableSeeder::class,
             TransactionsTableSeeder::class,
         ]);

    }
}
