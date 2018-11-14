{!! Html::link($btn_cancel_route,
    $btn_cancel_name,
    array_merge([
        'class' => 'btn btn-danger btn-simple',
        'title' =>  $btn_cancel_name
    ], $btn_cancel_attributes),
    $btn_cancel_secure,
    $btn_cancel_escape) !!}
