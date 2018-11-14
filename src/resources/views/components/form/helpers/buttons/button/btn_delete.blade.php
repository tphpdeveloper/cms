@php
$name =  $btn_delete_name != '' ? $btn_delete_name :
        (is_null($btn_delete_name) ? Html::tag('i', '', ['class' => 'fa fa-remove']) : '');
@endphp
{!! Form::button( $name,
    array_merge([
        'class' => 'btn btn-sm btn-danger btn-simple',
        'title' =>  $btn_delete_name != '' ? $btn_delete_name : '',
        'type' => 'submit'
    ], $btn_delete_attributes)
) !!}
