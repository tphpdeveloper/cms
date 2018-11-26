@php
    $pivot_id = $pivot_id ?? $image->pivot->id;

@endphp
<div class="card p-0" id="item_image_{{ $pivot_id }}">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2 col-sm-4 d-flex align-items-center">
                {!! Html::image($image->url, $image->alt, ['title' => $image->title]) !!}
            </div>
            <div class="col-sm-8">
                {!! Form::open(['route' => ['admin.slide-text.update', $model_key, 'image_id' => $image->id], 'method' => 'PUT', 'id' => 'js_slide_'.$pivot_id]) !!}
                {!! Form::bsText('text_1',' ', (isset($image->pivot) ? $image->pivot->text_1 : ''), true) !!}
                {!! Form::bsText('text_2',' ', (isset($image->pivot) ? $image->pivot->text_2 : ''), true) !!}
                {!! Form::bsText('text_3',' ', (isset($image->pivot) ? $image->pivot->text_3 : ''), true) !!}
                {!! Form::close() !!}
            </div>
            <div class="col-sm-12 col-md-2 d-flex justify-content-between flex-md-column align-items-md-center justify-content-md-center">
                    {!! Form::button(Html::tag('i', '', ['class' => 'now-ui-icons  loader_refresh spin']), [
                        'title' => trans('cms.helpers.button.update'),
                        'class' => 'btn btn-info btn-simple',
                        'data-original-title' => trans('cms.helpers.button.update'),
                        'onclick' => 'slideTextUpdate('.$pivot_id.')'
                    ]) !!}

                    {!! Form::button(Html::tag('i', '', ['class' => 'now-ui-icons ui-1_check']), [
                        'title' => trans('cms.helpers.button.main'),
                        'class' => 'js_btn_main_image btn '.($image->pivot && $image->pivot->main ? 'btn-primary' : 'btn-default btn-simple'),
                        'data-original-title' => trans('cms.helpers.button.main'),
                        'onclick' => 'mainImage(this, "'.route('admin.image_global.update', [$pivot_id, $model_key, $model_name] ).'")'
                    ]) !!}

                    {!! Form::button(Html::tag('i', '', ['class' => 'now-ui-icons ui-1_simple-remove']), [
                        'title' => trans('cms.helpers.button.delete'),
                        'class' => 'btn btn-danger btn-simple' ,
                        'data-original-title' => trans('cms.helpers.button.delete'),
                        'onclick' => 'deleteImage('.($pivot_id).', "'.route( 'admin.image_global.destroy', [$pivot_id, $model_key, $model_name] ).'")'
                    ]) !!}
            </div>
        </div>
    </div>
</div>
