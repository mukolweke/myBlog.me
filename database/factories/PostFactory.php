<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id'=> function () {
            return factory(App\User::class)->create()->id;
        },
        'title' => $faker->title,
        'body' => $faker->text,
        'priority'=>0,
        'cover_image'=>'noimage.jgp',
        'deleted_at'=>null,
    ];
});
