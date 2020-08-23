<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => '京都',
        'post' => 'とても綺麗だった',
        'user_id' => function() {
            return factory(User::class);
        }
    ];
});
