<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Http\Controllers;

use Tphpdeveloper\Cms\App\Models\LangStatic;
use Tphpdeveloper\Cms\App\Models\LangStaticValue;
use Datagrid;
use Form;
use Html;
use File;
use Storage;

class LangStaticController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->buildLanguagesFile();
    }

    /**
     * Build languages file from database
     */
    public function buildLanguagesFile()
    {
        $translates = LangStatic::with(['langStaticValue.lang'])
            ->orderBy('file', 'asc')
            ->orderBy('key', 'asc')
            ->get();
//        dd($translates);
        $default_data = [];
        foreach($translates as $co => $lang_static){
            $file = $lang_static->file;
            $key_name = $lang_static->key;
            foreach($lang_static->langStaticValue as $lang_static_value){
                $lang_name = $lang_static_value->lang->name;
                $value = $lang_static_value->value;


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
                if(!File::exists($file)){
                    Storage::disk('lang')->makeDirectory($lang);
                }
                File::put($file, print_r($data, true), FILE_APPEND);
                $data = File::get(resource_path('lang/'.$lang.'/'.$file_name.'.php'));
                $data = preg_replace("/(\[|\])/", "'", $data);
                $data = preg_replace("/Array(\s)*?\(/m", "[", $data);
                $data = preg_replace("/\)\n/m", "],", $data);
                $data = "<?php\nreturn ".substr($data, 0,-1).";\n?>";
                File::put(resource_path('lang/'.$lang.'/'.$file_name.'.php'), $data);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Tphpdeveloper\Cms\App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tphpdeveloper\Cms\App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Tphpdeveloper\Cms\App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tphpdeveloper\Cms\App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
