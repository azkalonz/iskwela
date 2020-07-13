<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $user_id = App\Models\User::inRandomOrder()->first()->id;
    $curr_date = $faker->date("Y-m-d H:i:s");
    $itemables = [
        "class" => App\Models\Classes::inRandomOrder()->first()->id,
        // to support for different models, just add another one here
    ];

    $itemable_type = array_rand($itemables);

    return [
        'body' => $faker->realText(200),
        'created_at' => $curr_date,
        'updated_at' => $curr_date,
        'created_by' => $user_id,
        'updated_by' => $user_id,
        'itemable_type' => $itemable_type,
        'itemable_id' => $itemables[$itemable_type]
    ];
});
