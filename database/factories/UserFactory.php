<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use App\Models\Ingredient;
use App\Models\Orders;
use App\Models\Pizza;
use App\Models\PizzaHasIngredient;
use App\Models\Rates;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Pizza::class, function (Faker $faker) {
    
    return [
        'name' => $faker->word,
        'size' => rand(15, 75)
    ];
});

$factory->define(Ingredient::class, function (Faker $faker) {
    
    return [
        'name' => $faker->word
    ];
});

$factory->define(PizzaHasIngredient::class, function (Faker $faker) {
    
    return [
        'cuantity' => rand(1, 1000)
    ];
});

$factory->define(Rates::class, function (Faker $faker) {
    
    return [
        'price' => rand(90, 400),
        'start' => $faker->dateTimeBetween('-1 month', 'now'),
        'end' => $faker->dateTimeBetween('now', '+1 month')
    ];
});

$factory->define(Orders::class, function (Faker $faker) {
    
    return [
        'hour' => $faker->time(),
        'status' => rand(0,5)
    ];
});

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'remember_token' => Str::random(10),
    ];
});