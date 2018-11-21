<?php
/**
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;


class Slider extends BackendModel
{


    protected $fillable = ['name'];

    /**
     * Get all of the images that are assigned this slide.
     */
    public function images()
    {
        return $this->morphToMany(Image::class, 'image_morph')->withPivot(['id', 'main', 'o']);
    }

}
