<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;


use Tphpdeveloper\Cms\App\Scopes\WithoutDisabledScope;

class Lang extends BackendModel
{

    protected $fillable = ['name', 'disabled'];
    protected $casts = [
        'disabled' => 'boolean',
    ];


    public function langStaticValue(){
        return $this->hasMany(LangStaticValue::class);
    }



}
