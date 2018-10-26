@php
    $data = [];
    if($languages){
        foreach($langs as $lang){
            if($multiple_lang || (!$multiple_lang && $lang == app()->getLocale())){
                $wishbone = '';
                if($multiple_lang){
                    $wishbone = ' ('.mb_strtoupper($lang).(app()->getLocale() == $lang ? ' *' : '') .')';
                }
                $data[] = [
                     'name' => $name.'['.$lang.']',
                     'value' => $value[$lang] ?? '',
                     'lang' => $lang,
                     'class' => (app()->getLocale() != $lang ? 'd-none ' : '').$class,
                     'attributes' => $attributes,
                     'label' => array_merge([
                            'name' => $name.'['.$lang.']',
                            'alias' => $alias.$wishbone
                         ],$label),
                ];
            }
        }
    }
    else{
        $data[] = [
             'name' => $name,
             'value' => $value,
             'lang' => '',
             'class' => $class,
             'attributes' => $attributes,
             'label' => array_merge([
                    'name' => $name,
                    'alias' => $alias
                 ],$label),
        ];
    }
@endphp
@each($folder_path.'components.form.card.text', $data, 'model')
