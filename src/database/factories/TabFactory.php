<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\Database\Factories;
 
use Faker\Generator as Faker;
use Faker\Factory;
use Tphpdeveloper\Cms\App\Models\Tab

$factory->define(Tab::class, function (Faker $faker) {
    $ru = Factory::create('ru_Ru');
    return [
        'name' => [
            'ru' => $ru->lastName,
            'en' => $faker->lastName
        ]
    ];
});
