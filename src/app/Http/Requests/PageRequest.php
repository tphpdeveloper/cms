<?php
/**
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
            'title' => 'array',
            'title.'.app()->getLocale() => 'required|min:5',
            'slug' => 'unique:pages,slug'.($this->page ? ','.$this->page->id : ''),
            'short_description' => 'array',
//            'short_description.*' => 'required',
            'description' => 'array',
//            'description.*' => 'required',
            'meta_title' => 'array',
//            'meta_title.*' => 'required',
            'meta_description' => 'array',
//            'meta_description.*' => 'required',
        ];
    }

    protected function validationData()
    {
        if(!$this->slug) {
            $slug = str_slug($this->input('title.'.app()->getLocale()), '_');
            //for validation data
            $this->merge([
                'slug' => $slug
            ]);
            //for old() function data
            app("request")->offsetSet('slug', $slug);
        }
        return $this->all();
    }




}
