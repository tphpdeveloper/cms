<?php

/**
 * Tphpdeveloper/CMS
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/CMS
 * @license   https://opensource.org/licenses/MIT
 */

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	    use \Themsaid\Multilingual\Translatable;
	
    protected $fillable = ['key', 'value', 'selected'];
    public $translatable = ['value'];	
    protected $casts = [
        'value' => 'array'
    ];

}
