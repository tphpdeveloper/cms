<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

use Faker\Generator as Faker;
use Faker\Factory;
use Tphpdeveloper\Cms\App\Models\Setting;

$factory->define(Setting::class, function (Faker $faker) {

    return [
        'name' => [],
        'key' => '',
        'value' => '',
        'value_translate' => [],
        'value_array' => [],
        'selected' => $faker->numberBetween(1, 10)
    ];
});
