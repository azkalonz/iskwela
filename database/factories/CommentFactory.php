<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

// Comments
$factory->define(Comment::class, function (Faker $faker) {
    $post_id = App\Models\Post::inRandomOrder()->first()->id;
    $user_id = App\Models\User::inRandomOrder()->first()->id;
    $curr_date = $faker->date("Y-m-d H:i:s");

    return [
        'body' => $faker->realText(),
        'created_at' => $curr_date,
        'updated_at' => $curr_date,
        'created_by' => $user_id,
        'updated_by' => $user_id,
        'post_id' => $post_id
    ];
});