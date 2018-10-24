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
use Tphpdeveloper\Cms\App\Models\Lang;

class LangStaticValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        $langs = Lang::all()->pluck('id', 'name')->toArray();
        $translate = include(base_path('vendor/tphpdeveloper/cms/src/resources/lang/translate.php'));

        foreach($translate as $name_file => $data){
            $this->buildData($data, $name_file, $langs);
        }

        //build languages file in resources/lang/lang name/name file
        (new LangStaticController())->buildLanguagesFile();
    }

    /**
     * @param array $data
     * @param string $name_file
     * @param array $langs
     * @param string $bilded_key
     */
    private function buildData(array $data, string $name_file, array $langs, string $bilded_key = ''): void
    {
        $build = false;
        $parent_key = '';
        foreach($data as $key => $value){
            if(is_array($value)){
                $this->buildData($value, $name_file, $langs, ($bilded_key == '' ? $key : $bilded_key.'.'.$key) );
            }
            else {
                if (!$build) {
                    //for create paren key in table lang_static
                    $parent_key = factory(LangStatic::class)->create([
                        'key' => $bilded_key,
                        'file' => $name_file,
                    ]);
                    $build = true;
                }
                //create value translate in table lang_static_value
                factory(LangStaticValue::class)->create([
                    'lang_static_id' => $parent_key->id,
                    'lang_id' => $langs[$key],
                    'value' => $value,
                ]);
            }

        }


    }
}
