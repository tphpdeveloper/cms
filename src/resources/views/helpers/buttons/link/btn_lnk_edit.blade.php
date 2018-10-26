{!! Html::link($btn_edit_route,
    $btn_edit_name,
    array_merge([
        'class' => 'btn btn-sm text-success btn-neutral',
        'title' =>  trans('setting.button.edit')
    ], $btn_edit_attributes),
    $btn_edit_secure,
    $btn_edit_escape) !!}

