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
            'name' => [
                'en' => 'Color sidebar',
                'ru' => 'Цветовая тема sidebar'
            ],
            'key' => 'color_scheme',
            'value' => 'blue',
        ]);

        factory(Setting::class)->create([
            'name' => [
                'en' => 'Title site',
                'ru' => 'Заголовок сайта'
            ],
            'key' => 'main_title',
            'value_translate' => [
                'en' => 'Title site',
                'ru' => 'Заголовок сайта'
            ],
        ]);

		factory(Setting::class)->create([
            'name' => [
                'en' => 'Description site',
                'ru' => 'Описание сайта'
            ],
            'key' => 'main_description',
            'value_translate' => [
                'en' => 'description site',
                'ru' => 'Описание сайта'
            ],
        ]);

        factory(Setting::class)->create([
            'name' => [
                'en' => 'Count element on a page in admin panel',
                'ru' => 'Количество элементов на стр. в админ-панели'
            ],
            'key' => 'count_item_on_admin_page',
            'value' => 3,
        ]);

        factory(Setting::class)->create([
            'name' => [
                'en' => 'Languages site',
                'ru' => 'Язики сайта'
            ],
            'key' => 'lang',
            'value' => 'ru',
        ]);

        factory(Setting::class)->create([
            'name' => [
                'ru' => 'Мультиязичность'
            ],
            'key' => 'multiplelanguages',
            'disabled' => 1
        ]);

    }
}
