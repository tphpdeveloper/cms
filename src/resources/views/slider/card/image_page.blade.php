@php
$model_key = $model->id;
$model_name = basename(get_class($model));
@endphp
<div class="row">
    <div class="col-12">
        {!! Form::button(trans('cms.page.select_image'), [
            'class' => 'btn btn-success btn-simple',
            'alt' => trans('cms.page.select_image'),
            'title' => trans('cms.page.select_image'),
            'onclick' => 'selectImage("'.route('admin.image_global.index').'")'
            ])!!}

    </div>
</div>
<div class="row mt-3">
    <div class="col-12 parent_pages_imagess" id="js_parent_pages_images">
        @if(isset($model) && $images = $model->images)
            @foreach($images as $image)
                @include($prefix.'slider.card.item_image',['image' => $image, 'model_key' => $model_key, 'model_name' => $model_name])
            @endforeach
        @endif
        <h6 class="w-100 text-center  @if(isset($model) && count($model->images)) d-none @endif js-text-no-image">
            @lang('cms.page.no_image')
        </h6>
    </div>

</div>
@include($prefix.'layout.modal.select_image_global', ['model_key' => $model_key, 'model_name' => $model_name, 'view' => $prefix.'slider.card.item_image'])

@push('script')
    <script>
        // change main image from slider
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

        //delete image slider
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
                            $("#item_image_" + data.to_main_id)
                                .find( $("button.js_btn_main_image") )
                                .removeClass('btn-simple')
                                .removeClass('btn-default')
                                .addClass('btn-primary');
                        }
                        else {
                            $(".js_btn_main_image")
                                .removeClass('btn-primary')
                                .addClass("btn-simple")
                                .addClass("btn-default");
                        }
                        $("#item_image_"+pivot_id).remove();
                        if(!data.count){
                            $(".js-text-no-image").removeClass('d-none')
                        }
                        else{
                            $(".js-text-no-image").addClass('d-none')
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

        //update slide text on image
        function slideTextUpdate(pivot_id){
            showPreloader();

            $.ajax({
                method: "POST",
                url: $('#js_slide_'+pivot_id).attr('action'),
                data: $('#js_slide_'+pivot_id).serialize(),
                success: function(data){
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
