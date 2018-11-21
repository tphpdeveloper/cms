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
        $co = 1;
        foreach($items as $name => $item){
            if(isset($item['parent'])){
                $item['data']['admin_menu_id'] = $parent_id[$item['parent']];
            }
            $item['data']['o'] = $co;
            $parent_id[$name] = factory(AdminMenu::class)->create($item['data'])->id;
            ++$co;
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
                    'icon' => 'media-2_sound-wave',
                ]
            ],

            'slider' => [
                'data' => [
                    'name' => [
                        'ru' => 'Слайдер'
                    ],
                    'route' => 'admin.slider.index',
                    'icon' => 'media-1_album',
                ]
            ],

            'page' => [
                'data' => [
                    'name' => [
                        'ru' => 'Страницы'
                    ],
                    'route' => 'admin.page.index',
                    'icon' => 'education_paper',
                ]
            ],

            'setting' => [
                'data' => [
                    'name' => [
                        'ru' => 'Настройки'
                    ],
                    'icon' => 'ui-1_settings-gear-63',
                ]
            ],



            'main' => [
                'parent' => 'setting',
                'data' => [
                    'name' => [
                        'ru' => 'Основные'
                    ],
                    'route' => 'admin.setting.index',
                    'icon' => 'ui-2_settings-90',
                ]
            ],

            'lang_static' => [
                'parent' => 'setting',
                'data' => [
                    'name' => [
                        'ru' => 'Статические переводы'
                    ],
                    'route' => 'admin.lang-static.index',
                    'icon' => 'text_caps-small',
                ]
            ],

            'catalog_images' => [
                'parent' => 'setting',
                'data' => [
                    'name' => [
                        'ru' => 'Каталог изображений'
                    ],
                    'route' => 'admin.image.index',
                    'icon' => 'design_image',
                ]
            ],

            'langs' => [
                'parent' => 'setting',
                'data' => [
                    'name' => [
                        'ru' => 'Языки'
                    ],
                    'route' => 'admin.lang.index',
                    'icon' => 'location_world',
                ]
            ],

        ];
    }
}
