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

    protected $fillable = ['key', 'value_translate', 'value', 'selected'];
    public $translatable = ['value_translate'];
    protected $casts = [
        'value_translate' => 'array',
        'value' => 'array'
    ];

//    public function getValueAttribute($value)
//    {
//
//        if($this->value_translate){
//            return $this->value_translate;
//        }
//
//        $res = json_decode($value);
//        if(count($res) == 1){
//            return array_shift($res);
//        }
//
//        return $res;
//    }


}
