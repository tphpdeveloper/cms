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

    protected $fillable = ['tab_id', 'label_id', 'key', 'value_translate', 'value', 'selected'];
    public $translatable = ['value_translate'];
    protected $casts = [
        'value_translate' => 'array',
        'value' => 'array'
    ];

    /**
     * link with tabs table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tab(){
        return $this->belongsTo(Tab::class);
    }

    /**
     * link with labels table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function label(){
        return $this->belongsTo(Label::class);
    }


}
