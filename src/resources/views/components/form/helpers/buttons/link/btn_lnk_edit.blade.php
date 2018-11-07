{!! Html::link($btn_edit_route,
    $btn_edit_name,
    array_merge([
        'class' => 'btn btn-sm btn-success btn-simple',
        'title' =>  trans('cms.helpers.button.edit')
    ], $btn_edit_attributes),
    $btn_edit_secure,
    $btn_edit_escape) !!}

