<?php
/**
 * Tphpdeveloper/CMS
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/CMS
 * @license   https://opensource.org/licenses/MIT
 */

namespace App\Http\ViewComposer;

use Illuminate\View\View;
use App\Models\Backend\Setting;

class LangComposer
{


    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $langs = Setting::where('key', 'langs')->first();
        $view->with('langs', $langs->value);
    }
}
