<?php

/**
 * Tphpdeveloper/CMS
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/CMS
 * @license   https://opensource.org/licenses/MIT
 */

use Faker\Generator as Faker;
use App\Models\Backend\Setting;
use Faker\Factory;

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
