<?php

use Faker\Generator as Faker;

$factory->define(App\Entity\Post\Post::class, function (Faker $faker) {
    return [
        'category_id' => function() {
            return \App\Entity\Post\Category::all()->random();
        },
        'title' => $title = $faker->sentence(5),
        'slug' => str_slug($title),
        'content' => $faker->text(250),
        'description' => $faker->text(6),
        'keywords' => $faker->word,
        'status' => 'published'
    ];
});
