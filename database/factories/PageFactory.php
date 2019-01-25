<?php

use Faker\Generator as Faker;

$factory->define(App\Entity\Page::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->text(5),
        'slug' => str_slug($title),
        'content' => $faker->text(250),
        'description' => $faker->text(6),
        'keywords' => $faker->word,
    ];
});
