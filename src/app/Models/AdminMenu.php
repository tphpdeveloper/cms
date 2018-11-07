<?php
/**
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;


class AdminMenu extends BackendModel
{
    protected $fillable = ['admin_menu_id', 'name', 'route', 'disabled'];
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


}
