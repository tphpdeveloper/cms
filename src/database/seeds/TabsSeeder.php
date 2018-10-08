<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

use Illuminate\Database\Seeder;
use Tphpdeveloper\Cms\App\Models\Tab;

class TabsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tab::class)->create([
            'name' => [
                'ru' => 'Главная',
                'en' => 'Main',
            ]
        ]);
        factory(Tab::class)->create([
            'name' => [
                'ru' => 'Изображения',
                'en' => 'Images',
            ]
        ]);
        factory(Tab::class)->create([
            'name' => [
                'ru' => 'Языки',
                'en' => 'Languages',
            ]
        ]);
    }
}
