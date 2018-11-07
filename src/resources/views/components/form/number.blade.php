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
        'class' => 'form-group'.$class_color_valid
    ];
@endphp

{!! Form::bsFormGroup(
    Form::bsLabel( $name, $alias . (in_array('required', $attributes) ? ' *' : '') ).
    Form::number( $name, $value ?? old($name), array_merge(['class' => 'form-control', 'min' => 0], $attributes ) ).
    Form::bsErrors($name),
    $form_group_attributes
) !!}
