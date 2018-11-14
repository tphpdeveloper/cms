<?php
/**
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;

use Themsaid\Multilingual\Translatable;

class Slider extends BackendModel
{

    use Translatable;

    protected $fillable = ['name', 'text_1', 'text_2', 'text_3'];
    public $translatable = [
        'text_1',
        'text_2',
        'text_3',
    ];
    protected $casts = [
        'text_1' => 'array',
        'text_2' => 'array',
        'text_3' => 'array',
    ];

    /**
     * Get all of the images that are assigned this slide.
     */
    public function images()
    {
        return $this->morphToMany(Image::class, 'image_morph')->withPivot(['id', 'main']);
    }

}
