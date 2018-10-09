<div class="col-md-3">
    <div class="card ">
        <div class="card-body">
            @include(config('myself.folder').'.components.form.select',[
                'value' =>  $langs,
                'selected' => array_flip($langs)[app()->getLocale()],
                'attributes' => [
                    'id' => 'js_lang_switcher'
                ],
            ])
        </div>
    </div>
</div>


@push('script')
    <script>
    $("#js_lang_switcher").change(function(e){
        var lang = this.options[this.selectedIndex].text;

        if($(".js_lang_switcher").length){

            $(".js_lang_switcher").addClass('d-none');
            $(".js_lang_switcher[lang='"+lang+"']").removeClass('d-none');
        }
    });
    </script>
@endpush
