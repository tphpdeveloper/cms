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
use Request;

class BackendController extends Controller
{

    public function getAdminElementOnPage(): int
    {
        return Setting::where('key', 'count_item_on_admin_page')->first(['value'])->value;
    }

    public function getPrefix(): string
    {
        return View::shared('prefix');
    }

    public function getFolderPath(): string
    {
        return View::shared('folder_path');
    }

    public function isMultilingual(): bool
    {
        return View::shared('multilingual');
    }

    public function setPageToSession(): void
    {
        //for after update, return to needed page
        if(Request::has('page')){
            session()->forget('page');
            session(['page' => Request::get('page')]);
        }
    }

    public function getPageFromSession(): array
    {
        $data = [];
        if(session()->has('page')){
            $data['page'] = session('page');
            session()->forget('page');
        }
        return $data;
    }
}
