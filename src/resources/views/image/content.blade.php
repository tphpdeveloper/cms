@extends($folder_path.'layout.pages.page_image')

@section('page_image_body')
    <div class="row thumbnail_images ">
        @if(isset($images) && $images)
            @foreach($images as $image)
                @include($folder_path.'image.item')
            @endforeach
            @unset($image)
        @endif
        <div class="col-12 card js_card_no_image @if(isset($images) && $images) d-none @endif">
            <div class="card-body text-center">{{ trans('cms.page.no_image') }}</div>
        </div>
    </div>
    @if(isset($images) && $images)
        <div class="d-flex justify-content-center" >
            {!! $images->links('vendor.pagination.bootstrap-4') !!}
        </div>
    @endif
@endsection

@push('script')
    <script>

        //save preview image
        function storeImage(){
            showPreloader();
            var formData = new FormData($("#js_form_update_image")[0]);
            $.ajax({
                url: "{{ route('admin.image.store') }}",
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    if(data.status === 'ok') {
                        if(!$(".js_card_no_image").hasClass('d-none')){
                            $(".js_card_no_image").addClass('d-none');
                        }
                        $("#single").html(data.form);
                        $(".thumbnail_images").prepend($(data.item));
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

        //update inform image
        function updateImage(image_id){
            showPreloader();
            var form = $("#js_form_update_image");
            var url = form.find("input[name='route']").val();

            if(url.replace(/^\s*/, '').replace(/\s*$/, '') === ''){
                dangerNotification("{{ trans('cms.notification.error.no_data_for_update') }}");
                return false;
            }

            $.ajax({
                url: url,
                method: "PUT",
                data: form.serialize(),
                dataType: 'json',
                success: function(data){
                    if(data.status === 'ok') {
                        $("#single").html(data.form);
                        $("#item_image_" + image_id).replaceWith(data.item);
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

        //select preview image
        function uploadPreviewImage(image){
            if (typeof (FileReader) != "undefined") {
                showPreloader();
                // var image = $(this)[0];
                if(image.files && image.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        var lastIndex = image.files[0].name.lastIndexOf(".");       // position last dot
                        var withoutDot = image.files[0].name.substring(0, lastIndex);

                        $(".js_has_image").attr('src', e.target.result);
                        $(".js_has_image").removeClass('d-none');
                        $(".js_no_image").addClass('d-none');
                        $("#single .card-body input[name^='alt']").val(image.files[0].name);
                        $("#single .card-body input[name^='title']").val(withoutDot);
                        $(".js_upload_image_parent").removeClass('d-none').addClass('d-flex');
                        $(".js_update_image_parent").removeClass('d-flex').addClass('d-none');
                    }
                    reader.readAsDataURL(image.files[0]);
                }
                hidePreloader();
            } else {
                dangerNotification("{{ trans('cms.notification.error.browser_not_support_file_reader') }}");
            }
        }

        //change preview image
        function deletePreviewImage(){
            showPreloader();
            $("#js_form_update_image").trigger('reset');
            $(".js_has_image").addClass('d-none');
            $(".js_no_image").removeClass('d-none');
            $(".js_upload_image_parent").removeClass('d-flex').addClass('d-none');
            $(".js_update_image_parent").removeClass('d-none').addClass('d-flex');
            hidePreloader();
        };

        //edit image
        function editImage(route) {
            showPreloader();

            $.ajax({
                "method": "GET",
                "url": route,
                "success": function (data) {
                    $("#single").html(data);
                    hidePreloader();

                },
                "error": function (jqXHR, status) {
                    hidePreloader();
                    jqXHRNotification(jqXHR);
                }
            });
        };

        //delete image
        function deleteImage(image_id, route){
            showPreloader();

            $.ajax({
                method: "POST",
                url: route,
                data: {
                    _method: "DELETE",
                    _token: "{{ csrf_token() }}"
                },
                success: function (data) {
                    if(data.status === 'ok') {
                        $("#item_image_" + image_id).remove();
                        if(!data.count){
                            $(".js_card_no_image").removeClass('d-none');
                        }
                    }
                    hidePreloader();
                    showNotification(data);

                },
                error: function (jqXHR, status) {
                    hidePreloader();
                    jqXHRNotification(jqXHR);
                }
            });
        }

    </script>
@endpush
