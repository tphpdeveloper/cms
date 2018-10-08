<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */
 
use Faker\Generator as Faker;
use Tphpdeveloper\Cms\App\Models\Label;

$factory->define(Label::class, function (Faker $faker) {
    return [
        'name' => []
    ];
});
