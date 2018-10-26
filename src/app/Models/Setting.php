<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;

use Illuminate\Database\Eloquent\Builder;

class Setting extends BackendModel
{
	    use \Themsaid\Multilingual\Translatable;

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
        static::addGlobalScope('disabled', function(Builder $builder){
            //return $builder->whereDisabled(0);
        });
    }



}
