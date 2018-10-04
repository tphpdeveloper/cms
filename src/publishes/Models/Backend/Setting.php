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
    protected $fillable = ['key', 'value', 'selected'];

    protected $casts = [
        'value' => 'array'
    ];

    public function getValueAttribute($value){
        if(count($value) == 1){
            return array_shift($value);
        }
        return $value;
    }
}
