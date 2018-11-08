<?php
/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Http\Middleware;

use Closure;
use Menu;
use Tphpdeveloper\Cms\App\Models\AdminMenu;

class AdminMenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->isJson()
            && !$request->isMethod('PUT')
            && !$request->isMethod('POST')
            && !$request->isMethod('DELETE')
        ) {
            $items = AdminMenu::all();
//            dd($items);
            Menu::make('MainMenu', function ($menu) use ($items) {
                foreach($items as $item) {
                    $route = (!is_null($item->route) ? ['route' => $item->route] : '#');
                    if(is_null($item->admin_menu_id)) {
                        $menu->add($item->name, $route)
                            ->id($item->id)
                            ->data([
                                'icon' => $item->icon,
                            ]);
                    }
                    elseif($child = $menu->find($item->admin_menu_id)){
//                        $menu->find($item->admin_menu_id)
                        $child
                            ->add($item->name, $route)
                            ->id($item->id)
                            ->data([
                                'icon' => $item->icon,
                            ]);
                    }
                }
            });

        }
        return $next($request);
    }

}
