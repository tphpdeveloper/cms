<?php

namespace Tphpdeveloper\Cms\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingRequest extends FormRequest
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
        $data = [
            'value_translate' => 'array',
            'name' => 'required|min:5',
        ];
        if($this->has('key')){
           $data['key'] = 'required|unique:settings,key'.(isset($this->setting) ? ', '.$this->setting->id : '');
        }

        return $data;
    }

    protected function validationData()
    {
        if(!$this->key || trim($this->key) == '') {
            $key = str_slug($this->input('name'), '_');
            //for validation data
            $this->merge([
                'key' => $key
            ]);
            //for old() function data
            app("request")->offsetSet('key', $key);
        }
        return $this->all();
    }
}
