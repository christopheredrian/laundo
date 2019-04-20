<?php

use Illuminate\Database\Seeder;
use App\Transaction;
use App\Sale;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sampleSales = array(
            [
                'customer_first_name' => 'Kamille',
                'customer_last_name' => 'Genove',
                'phone' => '09452750069',
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'customer_first_name' => 'Sean',
                'customer_last_name' => 'David',
                'phone' => '09353757269',
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'customer_first_name' => 'Gian',
                'customer_last_name' => 'Bryant',
                'phone' => '09278786900',
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'customer_first_name' => 'Edward',
                'customer_last_name' => 'Cook',
                'phone' => '09453767288',
                'created_at' => \Carbon\Carbon::now(),
            ],
        );

        $sampleTransactions = array(
            [
                'amount' => 50,
                'user_id'=> 4,
                'sale_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'amount' => 69,
                'user_id'=> 4,
                'sale_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'amount' => 60,
                'user_id'=> 4,
                'sale_id' => 3,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'amount' => 80,
                'user_id'=> 4,
                'sale_id' => 4,
                'created_at' => \Carbon\Carbon::now(),
            ],
        );

        // Insert to DB array of sales and transactions
        Sale::insert($sampleSales);
        Transaction::insert($sampleTransactions);
    }
}
