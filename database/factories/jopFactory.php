<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Jop::class, function (Faker $faker) {
    return [
        'title_ar' => $faker->title_ar,
        'title_en' => $faker->title_en,
        'title_ca' => $faker->title_ca,
        'icon'=>'1,png',
        'count'=>5,
        'remember_token' => Str::random(10),

    ];
});
