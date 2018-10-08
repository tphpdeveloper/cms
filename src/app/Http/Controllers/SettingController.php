<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Http\Controllers;

use Tphpdeveloper\Cms\App\Models\Setting;
use Cache;

class SettingController extends BackendController
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
