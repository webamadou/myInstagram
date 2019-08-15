<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $user = \App\User::all()->random(1)->first();
    return [
        'user_id' => $user->id,
        'caption' => $faker->sentence,
        'image' => $faker->imageUrl(),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
