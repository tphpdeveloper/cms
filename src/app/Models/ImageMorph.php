<?php
/**
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class ImageMorph extends MorphPivot
{

    protected $fillable = [
        'image_morph_type',
        'image_morph_id',
        'image_id',
        'main',
        'o',
        'text_1',
        'text_2',
        'text_3',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'main' => 'boolean',
        'text_1' => 'array',
        'text_2' => 'array',
        'text_3' => 'array',
    ];

}
