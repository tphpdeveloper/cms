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
use App\Http\Controllers\Controller;
use Cache;

class SettingController extends Controller
{
    public function show()
    {

        $setting = Cache::remember('admin_setting', 1, function(){
            return Setting::with(['tab', 'label'])->get();
        })
        ->keyBy(function($item){
            return $item->key;
        });

        return view(config('myself.folder').'.setting.show')
            ->with('model', $setting);
    }
}
