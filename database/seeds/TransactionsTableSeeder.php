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
        $sampleTransactions = array(
            [
                'amount' => 50,
                'user_id'=> 4,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'amount' => 69,
                'user_id'=> 4,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'amount' => 60,
                'user_id'=> 4,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'amount' => 80,
                'user_id'=> 4,
                'created_at' => \Carbon\Carbon::now(),
            ],
        );

        $sampleSales = array(
            [
                'customer_first_name' => 'Kamille',
                'customer_last_name' => 'Genove',
                'phone' => '09452750069',
                'transaction_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'customer_first_name' => 'Sean',
                'customer_last_name' => 'David',
                'phone' => '09353757269',
                'transaction_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'customer_first_name' => 'Gian',
                'customer_last_name' => 'Bryant',
                'phone' => '09278786900',
                'transaction_id' => 3,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'customer_first_name' => 'Edward',
                'customer_last_name' => 'Cook',
                'phone' => '09453767288',
                'transaction_id' => 4,
                'created_at' => \Carbon\Carbon::now(),
            ],
        );

        // Insert to DB array of sales and transactions
        Transaction::insert($sampleTransactions);
        Sale::insert($sampleSales);
    }
}
