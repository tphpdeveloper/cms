<?php
/**
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;


use Tphpdeveloper\Cms\App\Scopes\AdminMenuOrderByScope;
use Tphpdeveloper\Cms\App\Scopes\AdminMenuWithoutDisabledScope;
use Themsaid\Multilingual\Translatable;

class AdminMenu extends BackendModel
{
    use Translatable;

    protected $fillable = ['admin_menu_id', 'name', 'route', 'icon', 'o', 'disabled'];
    public $translatable = [
        'name',
    ];
    protected $casts = [
        'name' => 'array',
        'disabled' => 'boolean',
    ];

    public function children(){
        return $this->hasMany($this);
    }

    /**
     * Add global scope to select setting where disabled = 0
     */
    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new AdminMenuWithoutDisabledScope);
        static::addGlobalScope(new AdminMenuOrderByScope);
    }


}
