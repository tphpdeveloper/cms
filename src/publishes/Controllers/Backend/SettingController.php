<?php

/**
 * Tphpdeveloper/CMS
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/CMS
 * @license   https://opensource.org/licenses/MIT
 */

namespace App\Http\Controllers\Backend;

use App\Models\Backend\Setting;
//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datagrid;
use Request;

class SettingController extends Controller
{
    public function show()
    {
        dump(Request::get('f'));
        $setting = Setting::paginate(10);
        $grid = new Datagrid($setting, Request::get('f', []));
        $grid
            ->setColumn('id', '#', [])
            ->setColumn('key', 'Ключ', [])
            ->setColumn('value', 'Значение', [
                // Wrapper closure will accept two params
                // $value is the actual cell value
                // $row are the all values for this row
                'wrapper'     => function ($value, $row) {
                    $option = '';
                    foreach($value as $key => $item){
                        $option .= '<option value="'.$key.'">'.$item.'</option>';
                    }

                    return '<select name="value">'.$option.'</select>';
                }
            ])
            ->setColumn('selected', 'Выбранное', [
                'wrapper'     => function ($value, $row) {
                    if(!is_null($value) && $value != '' && $value != 'null'){
                        return $value;
                    }
                    return '';
                }
            ])
            // Setup action column
            ->setActionColumn([
                'wrapper' => function ($value, $row) {
//                    return '<a href="' . action('HomeController@index', $row->id) . '" title="Edit" class="btn btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
//					<a href="' . action('HomeController@index', $row->id) . '" title="Delete" data-method="DELETE" class="btn btn-xs text-danger" data-confirm="Are you sure?"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
                }
            ]);

        // Finally pass the grid object to the view
        return view(config('myself.folder').'.setting.show')
            ->with('grid', $grid);
    }
}
