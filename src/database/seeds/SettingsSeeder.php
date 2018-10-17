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
            'value' => null,
            'value_translate' => null,
            'value_array' => ['blue', 'green', 'orange', 'red', 'yellow'],
            'selected' => 0
        ]);

        factory(Setting::class)->create([
            'name' => [
                'en' => 'Title site',
                'ru' => 'Заголовок сайта'
            ],
            'key' => 'main_title',
            'value' => null,
            'value_translate' => [
                'en' => 'Title site',
                'ru' => 'Заголовок сайта'
            ],
            'value_array' => null,
            'selected' => null
        ]);

		factory(Setting::class)->create([
            'name' => [
                'en' => 'Description site',
                'ru' => 'Описание сайта'
            ],
            'key' => 'main_description',
            'value' => null,
            'value_translate' => [
                'en' => 'description site',
                'ru' => 'Описание сайта'
            ],
            'value_array' => null,
            'selected' => null
        ]);

        factory(Setting::class)->create([
            'name' => [
                'en' => 'Count element on a page in admin panel',
                'ru' => 'Количество элементов на стр. в админ-панели'
            ],
            'key' => 'count_item_on_admin_page',
            'value' => 3,
            'value_translate' => null,
            'value_array' => null,
            'selected' => null
        ]);

        factory(Setting::class)->create([
            'name' => [
                'en' => 'Languages site',
                'ru' => 'Язики сайта'
            ],
            'key' => 'langs',
            'value' => null,
            'value_translate' => null,
            'value_array' => ['ru','en'],
            'selected' => 0
        ]);

    }
}
