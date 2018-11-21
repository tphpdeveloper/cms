<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;


use Themsaid\Multilingual\Translatable;

class LangStatic extends BackendModel
{

    use Translatable;

    protected $fillable = ['key', 'file', 'name'];
    public $translatable = [
        'name',
    ];
    protected $casts = [
        'name' => 'array',
    ];

}
