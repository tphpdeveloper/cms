{!! Html::link($btn_cancel_route,
    $btn_cancel_name,
    array_merge([
        'class' => 'btn btn-danger',
        'title' =>  trans('setting.button.cancel')
    ], $btn_cancel_attributes),
    $btn_cancel_secure,
    $btn_cancel_escape) !!}
