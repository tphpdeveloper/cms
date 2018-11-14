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
                <div class="card p-0 d-flex flex-columt justify-content-between" id="item_image_{{ $image->pivot->id }}">
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
                                'class' => 'btn '.($image->pivot->main ? 'btn-primary' : 'btn-default btn-simple').' js_btn_main_image',
                                'data-original-title' => trans('cms.helpers.button.edit'),
                                'onclick' => 'mainImage(this, "'.route('admin.image_global.update', [$image->pivot->id, $model->id, basename(get_class($model))]).'")'
                            ]) !!}

                            {!! Form::button(Html::tag('i', '', ['class' => 'now-ui-icons ui-1_simple-remove']), [
                                'title' => trans('cms.helpers.button.delete').' '.$image->title,
                                'class' => 'btn btn-danger btn-simple js_btn_delete_image' ,
                                'data-original-title' => trans('cms.helpers.button.delete'),
                                'onclick' => 'deleteImage('.$image->pivot->id.', "'.route( 'admin.image_global.destroy', [$image->pivot->id, $model->id, basename(get_class($model))] ).'")'
                            ]) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <h6 class="w-100 text-center  @if(isset($model) && $model->images) d-none @endif js-text-no-image">
            @lang('cms.page.no_image')
        </h6>
    </div>

</div>

@push('script')
    <script>
        // change main image in model
        function mainImage(elem, route){
            showPreloader();
            $.ajax({
                method: "POST",
                url: route,
                data: {
                    _method: "PUT",
                    _token: "{{ csrf_token() }}"
                },
                success: function(data){
                    if(data.status === 'ok') {
                        $(".js_btn_main_image").removeClass('btn-primary').addClass("btn-simple").addClass("btn-default");
                        $(elem).removeClass('btn-simple').removeClass('btn-default').addClass('btn-primary');
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

        //delete image from model
        function deleteImage(pivot_id, route){
            showPreloader();
            $.ajax({
                method: "POST",
                url: route,
                data: {
                    _method: "DELETE",
                    _token: "{{ csrf_token() }}"
                },
                success: function(data){
                    if(data.status === 'ok') {
                        //set main image if previous main delete
                        if(data.to_main_id) {
                            $("#item_image_" + data.to_main_id).removeClass('btn-simple').removeClass('btn-default').addClass('btn-primary');
                        }
                        $(".js_btn_main_image").removeClass('btn-primary').addClass("btn-simple").addClass("btn-default");
                        $("#item_image_"+pivot_id).remove();
                        if(!data.count){
                            $(".js-text-no-image").removeClass('d-none')
                        }
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
