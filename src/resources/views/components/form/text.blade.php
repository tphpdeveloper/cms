@php
    $begin_name = $name;
    $begin_alis = $alias;
    $begin_value = $value;
    $data = [];

    foreach(config('multilingual.locales') as $lang){
        //if site multilingual $multilingual = true
        //and field multilingual $multiple_lang = true
        if( (!$multiple_lang || !$multilingual) && app()->getLocale() != $lang ){
            continue;
        }

        //if validate has errors, show color a field
        $class_color_valid = '';
        $error_name = $begin_name;
        if($errors->any() && (!key_exists('disabled', $attributes) && !in_array('disabled', $attributes) ) ){
            if($multiple_lang){
                //name for valid color text
                $error_name = $begin_name.'.'.$lang;
            }

            if( $errors->has($error_name) ){
                $class_color_valid = 'has-danger ';
            }
            elseif(!$errors->has($error_name)){
                $class_color_valid = 'has-success ';
            }

            if($multiple_lang){
                //name for error messages
                $error_name = $begin_name.'.*';
            }
        }


        //if a multilingual field
        if($multiple_lang){
            $name = $begin_name.'['.$lang.']';
            $value = $begin_value[$lang] ?? '';
            $alias = $begin_alis.( $multilingual ? ' ('.mb_strtoupper($lang).')' : '');

            //hide fields, how not equal a current lang
            $d_none = (app()->getLocale() != $lang ? 'd-none ' : '');

            $form_group_attributes['lang'] = $lang;
            $form_group_attributes['class'] = 'js_lang_switcher '.$d_none.$class_color_valid;


            $attributes['lang'] = $lang;
        }
        else{
            $form_group_attributes['class'] = $class_color_valid;
        }

        $data[] = [
            'name' => $name,
            'alias' => $alias . (in_array('required', $attributes) ? ' *' : ''),
            'value' => $value ?? old($name),
            'attributes' => $attributes,
            'form_group_attributes' => $form_group_attributes,
            'error_name' => $error_name,
        ];
    }


@endphp
@if(!$textarea)
    @each($prefix.'components.form.card.text', $data, 'data')
@else
    @each($prefix.'components.form.card.textarea', $data, 'data')
@endif
