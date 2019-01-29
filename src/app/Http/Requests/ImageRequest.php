<?php
/**
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'preview_image' => 'image'
//            'alt.ru' => 'min:6|',
//            'title.ru' => 'min:6',
        ];
    }





}
