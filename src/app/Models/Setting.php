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
use Tphpdeveloper\Cms\App\Scopes\SettingWithoutDisabledScope;

class Setting extends BackendModel
{
    use Translatable;

    protected $fillable = ['name', 'key', 'value', 'value_translate', 'o', 'disabled'];
    public $translatable = [
        'name',
        'value_translate'
    ];
    protected $casts = [
        'name' => 'array',
        'value_translate' => 'array',
        'disabled' => 'boolean',
    ];

    /**
     * Add global scope to select setting where disabled = 0
     */
    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new SettingWithoutDisabledScope);
    }



}
