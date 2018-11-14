<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 d-flex flex-row flex-nowrap" id="item_image_{{ $image->id }}">
    <div class="thumbnail  text-center w-100">
            <img src="{{ $image->url }}"
                 alt="{{ $image->alt }}"
                 title="{{ $image->title}}"
            >
            <div class="caption ">
                <p class="" style="word-wrap: break-word; ">{{ $image->title }}</p>
            </div>
    </div>
    <div class="parent-button-group">
        <div class="button-group d-flex flex-column">
            {!! Form::button(Html::tag('i', '', ['class' => 'now-ui-icons ui-2_settings-90']), [
                'type' => 'button',
                'rel' => 'tooltip',
                'title' => trans('cms.helpers.button.edit').' '.$image->title,
                'class' => 'btn btn-info btn-round btn-icon btn-icon-mini btn-neutral',
                'data-original-title' => trans('cms.helpers.button.edit'),
                'onclick' => 'editImage("'.route('admin.image.edit', $image->id).'")'
            ]) !!}

            {!! Form::button(Html::tag('i', '', ['class' => 'now-ui-icons ui-1_simple-remove']), [
                'type' => 'button',
                'rel' => 'tooltip',
                'title' => trans('cms.helpers.button.delete').' '.$image->title,
                'class' => 'btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral',
                'data-original-title' => trans('cms.helpers.button.delete'),
                'onclick' => 'deleteImage('.$image->id.', "'.route('admin.image.destroy', $image->id).'")'
            ]) !!}
        </div>
    </div>
</div>
