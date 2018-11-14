<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;
use Themsaid\Multilingual\Translatable;

class Image extends BackendModel
{
    use Translatable;

    private $path = 'uploads/images/';
    protected $fillable = ['name', 'alt', 'title'];
    public $translatable = [
        'alt',
        'title',
    ];
    protected $casts = [
        'alt' => 'array',
        'title' => 'array',
    ];
    protected $appends = ['url', 'fullpath'];


    public function getFullpathAttribute(){
        return $this->attributes['fullpath'] = public_path($this->path.$this->name);
    }

    public function getUrlAttribute(){
        return $this->attributes['url'] = asset($this->path.$this->name);
    }

}
