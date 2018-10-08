<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

use Faker\Generator as Faker;
use Faker\Factory;
use Tphpdeveloper\Cms\App\Models\Setting;

$factory->define(Setting::class, function (Faker $faker) {

    return [
        'tab_id' => $faker->numberBetween(1, 10),
        'label_id' => $faker->numberBetween(1, 10),
        'key' => '',
        'value_translate' => [],
        'value' => [],
        'selected' => $faker->numberBetween(1, 10)
    ];
});
