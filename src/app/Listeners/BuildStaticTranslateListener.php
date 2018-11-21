<?php
/**
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\Listeners;

use Tphpdeveloper\Cms\App\Models\LangStatic;
use File;
use Storage;

class BuildStaticTranslateListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        $translates = LangStatic::query()
            ->orderBy('file', 'asc')
            ->orderBy('key', 'asc')
            ->get();
        $default_data = [];
        foreach($translates as $co => $lang_static){
            $file = $lang_static->file;
            $key_name = $lang_static->key;
            $name_array = $lang_static->nameTranslations->toArray();

            foreach($name_array as $lang_name => $value){
                //if key == name1.name2.nameN
                if(strpos($key_name, '.') !== false){
                    $key_array = explode('.', $key_name);
                    $builded = [];
                    //explode string to array
                    foreach(array_reverse($key_array) as $co_key => $key) {
                        $make = [];
                        $make[$key] = (!$co_key) ? "'".$value."'," : $builded;
                        $builded = $make;
                    }

                    //if data not exist
                    if(!isset($default_data[$file][$lang_name]) ) {
                        $default_data[$file][$lang_name] = $builded;
                    }
                    else{
                        $default_data[$file][$lang_name] = array_merge_recursive($default_data[$file][$lang_name], $builded);
                    }
                }
                else {
                    $default_data[$file][$lang_name][$key_name] = "'".$value."',";
                }
            }

        }

        //write array to file and build needed structure
        foreach($default_data as $file_name => $lang_data){
            foreach($lang_data as $lang => $data){
                $file = resource_path('lang/'.$lang.'/'.$file_name.'.php');
                if( !File::exists( resource_path('lang/'.$lang) ) ){
                    Storage::disk('lang')->makeDirectory($lang);
                }
                File::put($file, print_r($data, true), FILE_APPEND);
                $data = File::get(resource_path('lang/'.$lang.'/'.$file_name.'.php'));
                $data = preg_replace("/(\[|\])/", "'", $data);
                $data = preg_replace("/Array(\s)*?\(/m", "[", $data);
                $data = preg_replace("/\)\n/m", "],", $data);
                //$data = preg_replace("/\n(\s{4,})/m", "\n", $data);
                //echo $data;
                ///dd($data);
//                $data = preg_replace("/\t{3}/m", "", $data);
                $data = "<?php\nreturn ".substr($data, 0,-1).";\n?>";
                File::put(resource_path('lang/'.$lang.'/'.$file_name.'.php'), $data);
            }
        }
    }
}
