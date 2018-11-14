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
use Tphpdeveloper\Cms\App\Models\Image;

$factory->define(Image::class, function (Faker $faker) {
    $basename = basename($faker->image(public_path('uploads/images')));
    $name = substr($basename, 0, -(mb_strlen($basename) - strpos($basename, '.')) );
    $data = [];
    foreach(config('multilingual.locales') as $lang){
        $data[$lang] = $name;
    }
    return [
        'name' => $basename,
        'alt' => $data,
        'title' => $data,
    ];
});
