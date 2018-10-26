{!! Html::link($btn_create_route,
    $btn_create_name,
    array_merge([
        'class' => 'btn btn-success',
        'title' =>  trans('setting.button.create')
    ], $btn_create_attributes),
    $btn_create_secure,
    $btn_create_escape) !!}
