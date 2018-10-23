<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;


class LangStatic extends BackendModel
{

    protected $fillable = ['key', 'file'];

    /**
     * link with table lang_static_value
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function langStaticValue()
    {
        return $this->hasMany(LangStaticValue::class);
    }

}
