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
use Tphpdeveloper\Cms\App\Models\Lang;

class LangComposer
{

    private $lang = null;

    public function __construct()
    {
        if( is_null( config('myself.langs') ) ) {
            $this->lang = Lang::all()->pluck('name', 'id')->toArray();
            config(['myself.langs' => $this->lang]);
        }
        else{
            $this->lang = config('myself.langs');
        }
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('langs', $this->lang);
    }
}
