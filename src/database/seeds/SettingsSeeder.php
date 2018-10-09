<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <kutsani@gmail.com>
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
            'tab_id' => 1,
            'label_id' => 1,
            'key' => 'color_scheme',
            'value' => null,
            'value_translate' => null,
            'value_array' => ['blue', 'green', 'orange', 'red', 'yellow'],
            'selected' => 0
        ]);

        factory(Setting::class)->create([
            'tab_id' => 1,
            'label_id' => 2,
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
            'tab_id' => 1,
            'label_id' => 3,
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
            'tab_id' => 1,
            'label_id' => 4,
            'key' => 'count_item_on_admin_page',
            'value' => 10,
            'value_translate' => null,
            'value_array' => null,
            'selected' => null
        ]);

        factory(Setting::class)->create([
            'tab_id' => 3,
            'label_id' => 5,
            'key' => 'langs',
            'value' => null,
            'value_translate' => null,
            'value_array' => ['ru','en'],
            'selected' => 0
        ]);

    }
}
