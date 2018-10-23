<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;


class Lang extends BackendModel
{

    protected $fillable = ['name'];


    public function langStaticValue(){
        return $this->hasMany(LangStaticValue::class);
    }

}
