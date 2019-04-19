<?php

use Illuminate\Database\Seeder;
use App\Transaction;

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
        $sampleTransactions = array(
            [
                'customer_name' => 'Kamille Genove',
                'customer_contact_number' => '09452750069',
                'amount' => 500,
                'date_of_transaction' => \Carbon\Carbon::now(),
                'responsible_employee_for_transaction' => 4
            ],
            [
                'customer_name' => 'Sean David',
                'customer_contact_number' => '09353757269',
                'amount' => 690,
                'date_of_transaction' => \Carbon\Carbon::now(),
                'responsible_employee_for_transaction' => 4
            ],
            [
                'customer_name' => 'Gian Bryant',
                'customer_contact_number' => '09278786900',
                'amount' => 500,
                'date_of_transaction' => \Carbon\Carbon::now(),
                'responsible_employee_for_transaction' => 4
            ],
            [
                'customer_name' => 'Edward Cook',
                'customer_contact_number' => '09453767288',
                'amount' => 690,
                'date_of_transaction' => \Carbon\Carbon::now(),
                'responsible_employee_for_transaction' => 4
            ],
        );

        // Insert to DB array of transactions
        Transaction::insert($sampleTransactions);
    }
}
