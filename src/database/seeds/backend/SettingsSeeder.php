<?php

/**
 * Tphpdeveloper/CMS
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/CMS
 * @license   https://opensource.org/licenses/MIT
 */

use Illuminate\Database\Seeder;
use App\Models\Backend\Setting;

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
            'key' => 'color-scheme',
            'value_translate' => null,
            'value' => ['blue', 'green', 'orange', 'red', 'yellow'],
            'selected' => 0
        ]);

        factory(Setting::class)->create([
            'key' => 'main_title',
            'value_translate' => [
                'en' => 'Title site',
                'ru' => 'Заголовок сайта'
            ],
            'value' => null,
            'selected' => null
        ]);

		factory(Setting::class)->create([
            'key' => 'main_description',
            'value_translate' => [
                'en' => 'description site',
                'ru' => 'Описание сайта'
            ],
            'value' => null,
            'selected' => null
        ]);

        factory(Setting::class)->create([
            'key' => 'count_item_on_admin_page',
            'value' => [10],
            'value_translate' => null,
            'selected' => 0
        ]);

    }
}
