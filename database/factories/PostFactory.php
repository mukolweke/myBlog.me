<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id'=> 1,
        'title' => $faker->title,
        'body' => $faker->text,
    ];
});
