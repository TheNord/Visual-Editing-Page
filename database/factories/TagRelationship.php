<?php

use Faker\Generator as Faker;

$factory->define(App\Entity\Post\TagRelationship::class, function (Faker $faker) {
    return [
        'tag_id' => function() {
            return \App\Entity\Post\Tag::all()->random();
        },
    ];
});
