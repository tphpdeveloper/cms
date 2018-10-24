<?php
/**
 * Tphpdeveloper/CMS
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/CMS
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Http\ViewComposer;

use Illuminate\View\View;
use Tphpdeveloper\Cms\App\Models\Setting;

class ColorSidebarComposer
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
        $color = Setting::where('key', 'color_scheme')->first();
        $view->with('color_sidebar', $color->value);
    }
}
