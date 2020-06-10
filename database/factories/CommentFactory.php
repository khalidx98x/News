<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Comment;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'post_id' => Post::all()->random()->id,
        'status' => $faker->randomElement(['0', '1']),
    ];
});
