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
use Tphpdeveloper\Cms\App\Models\LangStaticValue;

$factory->define(LangStaticValue::class, function (Faker $faker) {

    return [
        'lang_static_id' => 1,
        'lang_id' => 1,
        'value' => '',
    ];
});
