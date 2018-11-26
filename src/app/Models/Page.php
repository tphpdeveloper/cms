<?php
/**
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;
use Themsaid\Multilingual\Translatable;

class Page extends BackendModel
{
    use Translatable;

    protected $fillable = ['title', 'slug',  'short_description', 'description', 'meta_title', 'meta_description'];
    public $translatable = [
        'title',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
    ];
    protected $casts = [
        'title' => 'array',
        'short_description' => 'array',
        'description' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
    ];


    /**
     * Get all of the images that are assigned this page.
     */
    public function images()
    {
        return $this->morphToMany(Image::class, 'image_morph')->withPivot(['id', 'main', 'o', 'text_1', 'text_2', 'text_3']);
    }


}
