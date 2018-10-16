<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;


class Setting extends BackendModel
{
	    use \Themsaid\Multilingual\Translatable;

    protected $fillable = ['name', 'key', 'value', 'value_translate', 'value_array', 'selected'];
    public $translatable = [
        'name',
        'value_translate'
    ];
    protected $casts = [
        'name' => 'array',
        'value_translate' => 'array',
        'value_array' => 'array'
    ];



}
