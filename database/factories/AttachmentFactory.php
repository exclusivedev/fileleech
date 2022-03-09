<?php

use App\Models\Attachment;
use Faker\Generator as Faker;


/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Attachment::class, function (Faker $faker) {
    return [
        'text' => $faker->text,        
    ];
});
