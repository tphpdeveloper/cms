<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;

class Tab extends BackendModel
{
    use \Themsaid\Multilingual\Translatable;

    protected $fillable = ['name'];
    public $translatable = ['name'];
    protected $casts = [
        'name' => 'array'
    ];

    /**
     * link with settings table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings(){
        return $this->hasMany(Setting::class);
    }
}
