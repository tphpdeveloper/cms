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

class Tab extends Model
{
    use \Themsaid\Multilingual\Translatable;

    protected $fillable = ['name'];
    public $translatable = ['name'];
    protected $casts = [
        'name' => 'array'
    ];
}
