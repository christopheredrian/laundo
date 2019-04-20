<?php
/**
 * Created by PhpStorm.
 * User: m
 * Date: 2019-04-19
 * Time: 23:13
 */

namespace Tests\Feature\Models;


use App\Log;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LogTest extends TestCase
{

    /**
     * @test
     * @group unit
     */
    public function inserLogValidTest()
    {
        DB::beginTransaction();


        $logParams = [
            'message_for_params' => 'success'
        ];

        $logSaved = Log::insertLog(
            "Test log",
            "127.0.0.1",
            Log::TYPE_GENERIC,
            $logParams,
            null
        );

        $this->assertTrue($logSaved, "Failed to save logs");

        DB::rollBack();
    }

}