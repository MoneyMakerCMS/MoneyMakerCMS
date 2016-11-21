<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(\App\Models\Access\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Models\Content\Content::class, function (Faker\Generator $faker) {
    return [
        'name'       => 'App Name',
        'slug'       => 'app-name',
        'type'       => 'database',
        'html'       => 1,
        'value'      => '<b>MoneyMaker</b> CM<b>$</b>',
        'enabled'    => 1,
        'updated_at' => \Carbon\Carbon::now(),
        'created_at' => \Carbon\Carbon::now(),
    ];
});
