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
	$ru = Factory::create('ru_Ru');

    $values['en'] = $faker->safeColorName;
    $values['ru'] = $ru->safeColorName;

    return [
        'key' => $faker->word,
        'value_translate' => $values,
        'value' => $values,
        'selected' => $values['en']
    ];
});
