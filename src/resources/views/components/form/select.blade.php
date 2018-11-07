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

    $label_attributes = [];
    if(isset($attributes['label_attributes'])){
        $label_attributes = $attributes['label_attributes'];
        unset($attributes['label_attributes']);
    }
@endphp
{!! Form::bsFormGroup(
    Form::bsLabel( $name, $alias . (in_array('required', $attributes) ? ' *' : ''), $label_attributes).
    Form::select( $name, $list, $selected ?? old($name) , array_merge( ['class' => 'form-control'], $attributes ) ).
    Form::bsErrors( $name ),
    $class_color_valid
) !!}
