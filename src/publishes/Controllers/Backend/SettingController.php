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


class SettingController extends Controller
{
    public function show()
    {

        $setting = Setting::paginate(10);


        // Finally pass the grid object to the view
        return view(config('myself.folder').'.setting.show')
            ->with('model', $setting);
    }
}
