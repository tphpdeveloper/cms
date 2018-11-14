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
use Tphpdeveloper\Cms\App\Models\Slider;

$factory->define(Slider::class, function (Faker $faker) {

    $data = [];
    foreach(config('multilingual.locales') as $lang){
        $data[$lang] = $faker->text(100);
    }

    return [
        'name' => $faker->firstName,
        'text_1' => $data,
        'text_2' => $data,
        'text_3' => $data,
    ];
});
