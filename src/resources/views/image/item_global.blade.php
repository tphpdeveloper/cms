<div class="row">
    <div class="col-12">
        {!! Form::button(trans('cms.page.select_image'), [
            'class' => 'btn btn-success btn-simple',
            'alt' => trans('cms.page.select_image'),
            'title' => trans('cms.page.select_image'),
            'onclick' => 'selectImage('.route('admin.image_global.index').')'
            ])!!}

    </div>
</div>
<div class="row mt-3">
    <div class="col-12 d-flex flex-row flex-wrap justify-content-between parent_pages_images">
        @if(isset($model) && $images = $model->images)
            @foreach($images as $image)
                <div class="card p-0 d-flex flex-columt justify-content-between" id="item_image_{{ $image->id }}">
                    <div class="card-body">
                        <div class="thumbnail  text-center w-100">
                            <img src="{{ $image->url }}"
                                 alt="{{ $image->alt }}"
                                 title="{{ $image->title}}"
                            >
                            <div class="caption ">
                                <p class="" style="word-wrap: break-word; ">{{ $image->title }}</p>
                            </div>
                        </div>
                    </div>
                    <div class=" card-footer">
                        <div class="button-group d-flex flex-row justify-content-between">
                            {!! Form::button(Html::tag('i', '', ['class' => 'now-ui-icons ui-1_check']), [
                                'title' => trans('cms.helpers.button.edit').' '.$image->title,
                                'class' => 'btn btn-default btn-simple',
                                'data-original-title' => trans('cms.helpers.button.edit'),
                                'onclick' => 'mainImage("'.route('admin.image_global.update', [$image->pivot->id, $model->id, basename(get_class($model))]).'")'
                            ]) !!}

                            {!! Form::button(Html::tag('i', '', ['class' => 'now-ui-icons ui-1_simple-remove']), [
                                'title' => trans('cms.helpers.button.delete').' '.$image->title,
                                'class' => 'btn btn-danger btn-simple',
                                'data-original-title' => trans('cms.helpers.button.delete'),
                                'onclick' => 'deleteImage('.$image->pivot->id.', "'.route('admin.image_global.destroy', [$image->pivot->id, $model->id, basename(get_class($model))]).'")'
                            ]) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h6 class="w-100 text-center">@lang('cms.page.no_image')</h6>
        @endif
    </div>
</div>

@push('script')
    <script>
        function mainImage(route){
            $.ajax({
                method: "POST",
                url: route,
                data: {
                    _method: "PUT",
                    _token: "{{ csrf_token() }}"
                },
                success: function(data){
                    if(data.status === 'ok') {
                    }
                    hidePreloader();
                    showNotification(data);

                },
                error: function(jqXHR, status){
                    hidePreloader();
                    jqXHRNotification(jqXHR);
                }

            });
        }
    </script>
@endpush
