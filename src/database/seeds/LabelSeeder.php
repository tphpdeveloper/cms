<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

 
use Illuminate\Database\Seeder;
use Tphpdeveloper\Cms\App\Models\Label;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Label::class)->create([
            'name' => [
                'en' => 'Color admin panel',
                'ru' => 'Цвет админ панели'
            ]

        ]);

        factory(Label::class)->create([
            'name' => [
                'en' => 'Title site',
                'ru' => 'Заголовок сайта'
            ],
        ]);

        factory(Label::class)->create([
            'name' => [
                'en' => 'Description site',
                'ru' => 'Описание сайта'
            ],
        ]);

        factory(Label::class)->create([
            'name' => [
                'en' => 'Count items on page in admin panel',
                'ru' => 'Количество елементов на странице в админ панели'
            ],
        ]);

        factory(Label::class)->create([
            'name' => [
                'en' => 'Langs site',
                'ru' => 'Языки сайта'
            ],
        ]);
    }
}
