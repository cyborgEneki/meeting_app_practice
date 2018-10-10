<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->firstName(),
        'last_name' => $faker->lastName,
        'phone_number' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Media::class, function ($faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Venue::class, function ($faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Meetingtype::class, function ($faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Meetingseries::class, function ($faker) {
    return [
        'name' => $faker->word,
        'frequency' => $faker->word,
    ];
});

$factory->define(App\Note::class, function ($faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'meeting_id' => function () {
            return factory('App\Meeting')->create()->id;
        },
        'topic' => $faker->word,
        'description' => $faker->paragraph,
    ];
});

$factory->define(App\Meeting::class, function ($faker) {
    return [
        'venue_id' => function () {
            return factory('App\Venue')->create()->id;
        },
        'media_id' => function () {
            return factory('App\Media')->create()->id;
        },
        'meetingtype_id' => function () {
            return factory('App\Meetingtype')->create()->id;
        },
        'meetingseries_id' => function () {
            return factory('App\Meetingseries')->create()->id;
        },
        'name' => $faker->word,
        'date' => $faker->date,
        'start_time' => $faker->time,
        'end_time' => $faker->time,
        'creator' => function () {
            return factory('App\User')->create()->id;
        },
        'facilitator' => function () {
            return factory('App\User')->create()->id;
        },
        'time_keeper' => function () {
            return factory('App\User')->create()->id;
        },
    ];
});

$factory->define(App\Agenda::class, function ($faker) {
    return [
        'meeting_id' => function () {
            return factory('App\Meeting')->create()->id;
        },
        'topic' => $faker->word,
        'description' => $faker->paragraph,
        'time_allocated' => $faker->randomDigit,
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'agenda_status' => $faker->numberBetween($min = 0, $max = 1),
        'conclusion' => $faker->paragraph,
    ];
});

$factory->define(App\Followup::class, function ($faker) {
    return [
        'agenda_id' => function () {
            return factory('App\Agenda')->create()->id;
        },
        'action' => $faker->word,
        'owner' => function () {
            return factory('App\User')->create()->id;
        },
        'timeline' => $faker->dateTime,
        'status' => $faker->numberBetween($min = 0, $max = 1),
    ];
});

$factory->define(App\Discussion::class, function ($faker) {
    return [
        'agenda_id' => function () {
            return factory('App\Agenda')->create()->id;
        },
        'description' => $faker->text,
    ];
});