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
                     'alias' => $alias.$wishbone,
                     'value' => $value[$lang] ?? '',
                     'lang' => $lang,
                     'class' => (app()->getLocale() != $lang ? 'd-none ' : '').$class,
                     'attributes' => $attributes
                ];
            }
        }
    }
    else{
        $data[] = [
             'name' => $name,
             'alias' => $alias,
             'value' => $value,
             'lang' => '',
             'class' => $class,
             'attributes' => $attributes
        ];
    }
@endphp
@each(config('myself.folder').'.components.form.card.text', $data, 'model')
