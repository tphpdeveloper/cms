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
use Tphpdeveloper\Cms\App\Models\AdminMenu;

$factory->define(AdminMenu::class, function (Faker $faker) {

    return [
        'admin_menu_id' => null,
        'name' => [],
        'route' => null,
        'icon' => '',
        'o' => null,
        'disabled' => false,
    ];
});
