<?php

use Faker\Generator as Faker;

$factory->define(App\Entity\Menu::class, function (Faker $faker) {
    return [
        'type' => 0,
        'page_id' => $page = function() {
            return \App\Entity\Page::all()->random();
        },
        'category_id' => null,
        'title' => $faker->firstName
    ];
});
