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
use Tphpdeveloper\Cms\App\Models\Admin;

$factory->define(Admin::class, function (Faker $faker) {

    return [
        'name' => $faker->firstName,
        'email' => $faker->freeEmail,
        'password' => bcrypt($faker->password),
        'remember_token' => '',
    ];
});
