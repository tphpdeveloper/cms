<?php

/**
 * Tphpdeveloper/CMS
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/CMS
 * @license   https://opensource.org/licenses/MIT
 */

use Faker\Generator as Faker;
use Faker\Factory;

$factory->define(App\Models\Backend\Tab::class, function (Faker $faker) {
    $ru = Factory::create('ru_Ru');
    return [
        'name' => [
            'ru' => $ru->lastName,
            'en' => $faker->lastName
        ]
    ];
});
