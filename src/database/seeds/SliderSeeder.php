<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

use Illuminate\Database\Seeder;
use Tphpdeveloper\Cms\App\Models\Slider;
use Tphpdeveloper\Cms\App\Models\Image;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Slider::class, 2)->create()->each(function($slider){
            $first = true;
            $number = rand(2,5);
            for($i = 0; $i < $number; $i++) {
                $image = Image::inRandomOrder()->first();
                if($first) {
                    $slider->images()->save($image, ['main' => true]);
                }
                $slider->images()->save($image);
                $first = false;
            }
        });



    }
}
