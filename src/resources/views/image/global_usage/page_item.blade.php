@php
    $pivot_id = $pivot_id ?? $image->pivot->id;
@endphp
<div class="card p-0 d-flex flex-column justify-content-between" id="item_image_{{ $pivot_id }}">
    <div class="card-body">
        <div class="thumbnail  text-center w-100">
            {!! Html::image($image->url, $image->alt, ['title' => $image->title]) !!}
            <div class="caption ">
                <p class="" style="word-wrap: break-word; ">{{ $image->title }}</p>
            </div>
        </div>
    </div>
    <div class=" card-footer">
        <div class="button-group d-flex flex-row justify-content-between">
            {!! Form::button(Html::tag('i', '', ['class' => 'now-ui-icons ui-1_check']), [
                'title' => trans('cms.helpers.button.edit'),
                'class' => 'btn '.(($image->pivot ? $image->pivot->main : false) ? 'btn-primary' : 'btn-default btn-simple').' js_btn_main_image',
                'data-original-title' => trans('cms.helpers.button.edit'),
                'onclick' => 'mainImage(this, "'.route('admin.image_global.update', [$pivot_id, $model_key, $model_name] ).'")'
            ]) !!}

            {!! Form::button(Html::tag('i', '', ['class' => 'now-ui-icons ui-1_simple-remove']), [
                'title' => trans('cms.helpers.button.delete'),
                'class' => 'btn btn-danger btn-simple js_btn_delete_image' ,
                'data-original-title' => trans('cms.helpers.button.delete'),
                'onclick' => 'deleteImage('.($pivot_id).', "'.route( 'admin.image_global.destroy', [$pivot_id, $model_key, $model_name] ).'")'
            ]) !!}
        </div>
    </div>
</div>
