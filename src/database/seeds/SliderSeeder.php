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
            $number = rand(5,10);
            $images_id = [];
            for($i = 0; $i < $number; $i++) {
                $image = Image::inRandomOrder()->first();
                if($first) {
                    $slider->images()->attach($image->id, ['main' => 1]);
                    $first = false;
                    continue;
                }
                $images_id[] = $image->id;
            }
            $slider->images()->attach($images_id);
        });



    }
}
