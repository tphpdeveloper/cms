{!! Form::button($btn_delete_name, array_merge([
        'class' => 'btn btn-sm btn-danger btn-simple',
        'title' =>  trans('cms.helpers.button.delete'),
        'type' => 'submit'
    ], $btn_delete_attributes)
) !!}
