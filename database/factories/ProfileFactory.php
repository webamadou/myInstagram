<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    $user = \App\User::all()->random(1)->first();
    return [
        'user_id' => $user->id,
        'title' => $user->username,
        'description' => $faker->paragraph(3,true),
        'image' => $faker->imageUrl(),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
