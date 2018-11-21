@if(isset($images) && $images)
    @foreach($images as $image)
        <div class="card p-0 active" id="item_image_{{ $image->id }}">
            <div class="card-header d-flex justify-content-end" style="height: 0px;">
                {!! Form::button(Html::tag('i', '', ['class' => 'now-ui-icons ui-1_check']), [
                    'type' => 'button',
                    'rel' => 'tooltip',
                    'class' => 'btn btn-primary btn-round btn-icon btn-icon-mini  d-none',
                    'id' => 'js_btn_enabled_'.$image->id
                ]) !!}
            </div>
            <div class="card-body">
                <div class="thumbnail text-center ">
                    {!! Html::tag('label',
                        Html::image($image->url, $image->alt, ['title' => $image->title]).
                        Form::checkbox('images[]', $image->id, null, [
                            'class' => 'js_checkbox_selected_image d-none',
                            'onchange' => 'checkSelectImage('.$image->id.')',
                            ]),
                        ['class' => 'hello']
                    ) !!}

                </div>
            </div>
        </div>
    @endforeach
@endif
