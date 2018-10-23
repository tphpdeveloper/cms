<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;


class LangStaticValue extends BackendModel
{

    protected $fillable = ['lang_static_id', 'lang_id', 'value'];

    /**
     * link with table lang_statics and lang_static_values
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function key(){
        return $this->belongsTo(LangStatic::clss);
    }

    /**
     * link with table langs and lang_static_values
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lang(){
        return $this->belongsTo(Lang::class);
    }

}
