<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Http\Controllers;


use App\Http\Controllers\Controller;
use Tphpdeveloper\Cms\App\Models\Setting;
use View;

class BackendController extends Controller
{

    public function getAdminElementOnPage(){
        return Setting::where('key', 'count_item_on_admin_page')->first(['value'])->value;
    }

    public function getFolderPath(): string
    {
        return View::shared('folder_path');
    }

}
