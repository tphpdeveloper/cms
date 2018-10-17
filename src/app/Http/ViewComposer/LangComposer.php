<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Http\ViewComposer;

use Illuminate\View\View;
use Tphpdeveloper\Cms\App\Models\Setting;

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
        $view->with('langs', $langs->value_array);
    }
}
