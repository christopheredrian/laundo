<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Transaction;
use App\Sale;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Transaction::truncate();
        Sale::truncate();
        User::truncate();

        // Add as needed for new migrations but be CAUTIOUS! :)
        // Get UsersTableSeeder from seanyboyswag
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            TransactionsTableSeeder::class,
            LogsTableSeeder::class
        ]);

    }
}
