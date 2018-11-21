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
use Tphpdeveloper\Cms\App\Models\LangStatic;

$factory->define(LangStatic::class, function (Faker $faker) {

    return [
        'file' => '',
        'key' => '',
        'name' => [],
    ];
});
