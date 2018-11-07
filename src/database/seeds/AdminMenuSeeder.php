<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

use Illuminate\Database\Seeder;
use Tphpdeveloper\Cms\App\Models\AdminMenu;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = $this->dataMenu();
        $parent_id = [];
        foreach($items as $name => $item){
            if(isset($item['parent'])){
                $item['data']['admin_menu_id'] = $parent_id[$item['parent']];
            }
            $parent_id[$name] = factory(AdminMenu::class)->create($item['data'])->id;
        }

    }

    private function dataMenu(){
        return [
            'dashboard' => [
                'data' => [
                    'name' => [
                        'ru' => 'Панель состояния'
                    ],
                    'route' => 'admin.dashboard',
                ]
            ],
            'setting' => [
                'data' => [
                    'name' => [
                        'ru' => 'Настройки'
                    ],
                    'route' => '#',
                ]
            ],


            'main' => [
                'parent' => 'setting',
                'data' => [
                    'name' => [
                        'ru' => 'Основные'
                    ],
                    'route' => 'admin.setting.index',
                ]
            ],
            'page' => [
                'parent' => 'setting',
                'data' => [
                    'name' => [
                        'ru' => 'Страницы'
                    ],
                    'route' => 'admin.page.index',
                ]
            ],
            'lang_static' => [
                'parent' => 'setting',
                'data' => [
                    'name' => [
                        'ru' => 'Статические переводы'
                    ],
                    'route' => 'admin.lang-static.index',
                ]
            ],

        ];
    }
}
