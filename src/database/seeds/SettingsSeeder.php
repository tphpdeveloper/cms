<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\Database\Seeds;

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
            'value_translate' => null,
            'value' => ['blue', 'green', 'orange', 'red', 'yellow'],
            'selected' => 0
        ]);

        factory(Setting::class)->create([
            'tab_id' => 1,
            'label_id' => 2,
            'key' => 'main_title',
            'value_translate' => [
                'en' => 'Title site',
                'ru' => 'Заголовок сайта'
            ],
            'value' => null,
            'selected' => null
        ]);

		factory(Setting::class)->create([
            'tab_id' => 1,
            'label_id' => 3,
            'key' => 'main_description',
            'value_translate' => [
                'en' => 'description site',
                'ru' => 'Описание сайта'
            ],
            'value' => null,
            'selected' => null
        ]);

        factory(Setting::class)->create([
            'tab_id' => 1,
            'label_id' => 4,
            'key' => 'count_item_on_admin_page',
            'value_translate' => null,
            'value' => 10,
            'selected' => null
        ]);

        factory(Setting::class)->create([
            'tab_id' => 3,
            'label_id' => 5,
            'key' => 'langs',
            'value_translate' => null,
            'value' => ['ru','en'],
            'selected' => 0
        ]);

    }
}
