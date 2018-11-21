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
use Tphpdeveloper\Cms\Events\BuildStaticTranslateEvent;

class LangStaticSeeder extends Seeder
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
        event( new BuildStaticTranslateEvent());
    }

    /**
     * @param array $data
     * @param string $name_file
     * @param array $langs
     * @param string $bilded_key
     */
    private function buildData(array $data, string $name_file, array $langs, string $bilded_key = '')
    {
        $name = [];
        foreach($data as $key => $value){
            $res = false;
            if(is_array($value)){
                $this->buildData($value, $name_file, $langs, ($bilded_key == '' ? $key : $bilded_key.'.'.$key) );
            }
            else {
                $name[$key] = $value;

            }

        }
        if(count($name)) {
            //for create paren key in table lang_static
            factory(LangStatic::class)->create([
                'file' => $name_file,
                'key' => $bilded_key,
                'name' => $name,
            ]);
        }


    }
}
