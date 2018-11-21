<div class="modal fade" id="exampleModalLongImages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'id' => 'js_form_select_image_for_model']) !!}
                    <div class="col-12 d-flex flex-row flex-wrap justify-content-between parent_pages_images parent_modal_images">
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        //when click image show select icon
        function checkSelectImage(image_id){
            var btn_enabled = $('#exampleModalLongImages .card button#js_btn_enabled_'+image_id);
                btn_enabled.toggleClass('d-none')
        };

        //get list images
        function selectImage(route) {
            showPreloader();
            $.ajax({
                method: 'POST',
                url: route,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (data){
                    hidePreloader();
                    showNotification(data);
                    if(data.status === 'ok'){
                        $('html').removeClass('perfect-scrollbar-on');
                        $('html').addClass('perfect-scrollbar-off');
                        $("#exampleModalLongImages .parent_modal_images").html(data.items);
                        $("#exampleModalLongImages").modal();

                    }
                },
                error: function(jqXHR, status){
                    hidePreloader();
                    jqXHRNotification(jqXHR);
                }
            });
        }

        //after modal close
        $("#exampleModalLongImages").on('hidden.bs.modal', function (e) {
            showPreloader();
            $('html').removeClass('perfect-scrollbar-off');
            $('html').addClass('perfect-scrollbar-on');

            var form = $('#js_form_select_image_for_model');
            var checkboxes = $('#js_form_select_image_for_model input:checked');

            if(checkboxes.length) {
                $.ajax({
                    method: 'POST',
                    url: '{{ route('admin.image_global.store', [$model_key, $model_name]) }}',
                    data: form.serialize(),
                    success: function (data) {
                        if (data.status === 'ok') {
                            $('#js_parent_pages_images').append(data.items);
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
            else{
                hidePreloader();
            }
        })

    </script>
@endpush
