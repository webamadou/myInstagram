<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $post = \App\Post::all()->random(1)->first();
    $user = \App\User::all()->random(1)->first();
    return [
        'post_id' => $post->id,
        'user_id' => $user->id,
        'commentary' => $faker->sentence(12,true),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];
});
