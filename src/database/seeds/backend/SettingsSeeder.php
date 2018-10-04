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
            'value' => [
                "en" => ['blue', 'green', 'orange', 'red', 'yellow'],
                "ru" => ["голубой", "зеленый", "оранжевый", "красный", "жолтый"]
            ],
            'selected' => 0
        ]);

		factory(Setting::class, 20)->create();
    }
}
