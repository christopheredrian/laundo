<?php
use App\Log;
use Faker\Generator as Faker;


$factory->define(Log::class, function (Faker $faker) {

    $jsonArr = [
        'log_data' => $faker->sentence()
    ];

    return [
        'user_id' => null,
        'type' => $faker->randomElement(Log::VALID_TYPES),
        'ip' => $faker->ipv4,
        'message' => $faker->sentence,
        'log_params' => json_encode($jsonArr),
        'created_at' => $faker->dateTime,
    ];
});
