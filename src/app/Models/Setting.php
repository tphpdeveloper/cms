<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
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
