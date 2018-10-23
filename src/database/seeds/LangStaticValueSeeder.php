<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

use Illuminate\Database\Seeder;
use Tphpdeveloper\Cms\App\Models\LangStatic;
use Tphpdeveloper\Cms\App\Models\LangStaticValue;
use Tphpdeveloper\Cms\App\Http\Controllers\LangStaticController;

class LangStaticValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $langs = \Tphpdeveloper\Cms\App\Models\Lang::all()->pluck('id', 'name')->toArray();
        $translate = include(base_path('vendor/tphpdeveloper/cms/src/resources/lang/translate.php'));

        foreach($translate as $name_file => $data){
            $this->buildData($data, $name_file, $langs);
        }

        (new LangStaticController())->buildLanguagesFile();
    }

    /**
     * @param array $data
     * @param string $key
     * @return string
     */
    private function buildData(array $data, string $name_file, array $langs, string $bilded_key = ''): void
    {
        $builded = false;
        $parent_key = '';
        foreach($data as $key => $value){
            if(is_array($value)){
                $this->buildData($value, $name_file, $langs, ($bilded_key == '' ? $key : $bilded_key.'.'.$key) );
            }
            else {
                if (!$builded) {
                    $parent_key = factory(LangStatic::class)->create([
                        'key' => $bilded_key,
                        'file' => $name_file,
                    ]);
                    $builded = true;
                }
                factory(LangStaticValue::class)->create([
                    'lang_static_id' => $parent_key->id,
                    'lang_id' => $langs[$key],
                    'value' => $value,
                ]);
            }

        }


    }
}
