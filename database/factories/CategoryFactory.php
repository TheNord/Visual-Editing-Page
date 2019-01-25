<?php

use Faker\Generator as Faker;

$factory->define(App\Entity\Post\Category::class, function (Faker $faker) {
    return [
        'name' => $title = $faker->firstName,
        'slug' => str_slug($title),
        'description' => $faker->text(10),
    ];
});
