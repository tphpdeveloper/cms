@php
$name = $btn_reset_name != '' ? $btn_reset_name :
        ( is_null($btn_reset_name) ? trans('cms.helpers.button.reset') : '');
@endphp
{!! Form::reset($name,
    array_merge([
        'class' => 'btn  btn-simple',
        'title' =>  $name
    ], $btn_reset_attributes)
) !!}
