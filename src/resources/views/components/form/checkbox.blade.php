@php
    $class_color_valid = '';
    if($errors->any()){
        if( $errors->has($name) ){
            $class_color_valid = ' has-danger';
        }
        elseif(!$errors->has($name)){
            $class_color_valid = ' has-success';
        }

    }
    $form_group_attributes = [
        'class' => 'form-check'.$class_color_valid
    ];
@endphp

{!! Form::bsFormGroup(
    Form::hidden( $name, 0).

    Html::tag('label',
        Form::checkbox( $name, 1, $checked, array_merge(['class' => 'form-check-input'], $attributes ) ).
        Html::tag('span','',['class' => 'form-check-sign']).
        $alias . (in_array('required', $attributes) ? ' *' : ''),
        //style label
        ['class' => 'form-check-label']
    ).

    Form::bsErrors($name),
    //style form group
    $form_group_attributes
) !!}
