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
	$text_array = rand(0,1);
	$values = [];
	//array
	if($text_array){
		$number = rand(3, 10);
		for($i = 0; $i < $number; $i++){
			$values['en'][] = $faker->safeColorName;
			$values['ru'][] = $ru->safeColorName;
		}
	}
	else{
		$values['en'] = $faker->safeColorName;
		$values['ru'] = $ru->safeColorName;
	}

    return [
        'key' => $faker->word,
        'value' => $values,
        'selected' => ($text_array ? array_rand($values['en'], 1) : null)
    ];
});
