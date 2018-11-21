<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

use Illuminate\Database\Seeder;
use Tphpdeveloper\Cms\App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Setting::class)->create([
            'name' => 'Цветовая тема sidebar',
            'key' => 'color_scheme',
            'value' => 'orange',
            'disabled' => true
        ]);

        factory(Setting::class)->create([
            'name' => 'Заголовок сайта',
            'key' => 'main_title',
            'value_translate' => [
                'en' => 'Title site',
                'ru' => 'Заголовок сайта'
            ],
        ]);

		factory(Setting::class)->create([
            'name' => 'Описание сайта',
            'key' => 'main_description',
            'value_translate' => [
                'en' => 'description site',
                'ru' => 'Описание сайта'
            ],
        ]);

        factory(Setting::class)->create([
            'name' => 'Количество элементов на стр. в админ-панели',
            'key' => 'count_item_on_admin_page',
            'value' => 12,
        ]);

        factory(Setting::class)->create([
            'name' => 'Основной язик сайта',
            'key' => 'lang_front_end',
            'value' => 'ru',
            'disabled' => true
        ]);

        factory(Setting::class)->create([
            'name' => 'Основной язик админ-панели',
            'key' => 'lang_back_end',
            'value' => config('app.locale'),
            'disabled' => true
        ]);

        factory(Setting::class)->create([
            'name' => 'Мультиязичность',
            'key' => 'multiple_languages',
            'value' => 1,
            'disabled' => true
        ]);


    }
}
