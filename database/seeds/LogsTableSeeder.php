<?php

use Illuminate\Database\Seeder;
use App\Log;

class LogsTableSeeder extends Seeder
{
    /**
     * Number of logs to insert
     */
    const NUMBER_OF_LOGS = 100;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($counter = 0; $counter < self::NUMBER_OF_LOGS; $counter++)
            factory(Log::class)->create();

    }
}
